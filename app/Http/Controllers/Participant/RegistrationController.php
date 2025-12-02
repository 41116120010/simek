<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\RegistrationMember;
use App\Models\Payment;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    use ActivityLogger;

    /**
     * Display user's registrations.
     */
    public function index()
    {
        $registrations = Registration::with(['event', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('participant.registrations.index', compact('registrations'));
    }

    /**
     * Show registration form.
     */
    public function create(Event $event)
    {
        // Validasi event
        if (!$event->canRegister()) {
            return redirect()->route('participant.events.show', $event)
                ->with('error', 'Pendaftaran untuk event ini sudah ditutup atau sudah penuh.');
        }

        // Check if already registered
        $existingRegistration = Registration::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRegistration) {
            return redirect()->route('participant.registrations.show', $existingRegistration)
                ->with('info', 'Anda sudah terdaftar di event ini.');
        }

        $event->load(['requirements' => fn($q) => $q->orderBy('order')]);

        return view('participant.registrations.create', compact('event'));
    }

    /**
     * Store registration.
     */
    public function store(Request $request, Event $event)
    {
        // Validasi
        $rules = [
            'team_name' => $event->isCompetition() && in_array($event->competition_type, ['team', 'both']) ? 'required|string|max:255' : 'nullable',
            'notes' => 'nullable|string',
        ];

        // Dynamic validation for requirements
        if ($event->requirements->count() > 0) {
            foreach ($event->requirements as $requirement) {
                $fieldName = 'requirement_' . $requirement->id;
                $rules[$fieldName] = $requirement->is_required ? 'required' : 'nullable';
                
                if ($requirement->type === 'file') {
                    $rules[$fieldName] .= '|file|max:2048|mimes:jpg,jpeg,png,pdf';
                } elseif ($requirement->type === 'link') {
                    $rules[$fieldName] .= '|url';
                }
            }
        }

        // Team members validation
        if ($event->isCompetition() && in_array($event->competition_type, ['team', 'both'])) {
            $rules['members'] = 'required|array|min:' . ($event->min_team_members - 1);
            $rules['members.*.name'] = 'required|string|max:255';
            $rules['members.*.email'] = 'required|email';
            $rules['members.*.phone'] = 'nullable|string|max:15';
        }

        $validated = $request->validate($rules, [
            'team_name.required' => 'Nama tim wajib diisi.',
            'members.required' => 'Anggota tim wajib diisi.',
            'members.min' => 'Minimal ' . ($event->min_team_members - 1) . ' anggota tim.',
        ]);

        DB::beginTransaction();
        try {
            // Process requirement answers
            $requirementAnswers = [];
            foreach ($event->requirements as $requirement) {
                $fieldName = 'requirement_' . $requirement->id;
                if ($request->has($fieldName)) {
                    if ($requirement->type === 'file' && $request->hasFile($fieldName)) {
                        $file = $request->file($fieldName);
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/requirements'), $fileName);
                        $requirementAnswers[$requirement->id] = $fileName;
                    } else {
                        $requirementAnswers[$requirement->id] = $request->$fieldName;
                    }
                }
            }

            // Create registration
            $registration = Registration::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'team_name' => $validated['team_name'] ?? null,
                'requirement_answers' => $requirementAnswers,
                'notes' => $validated['notes'] ?? null,
                'status' => $event->is_free ? 'pending' : 'waiting_payment',
            ]);

            // Create team members if team competition
            if ($event->isCompetition() && isset($validated['members'])) {
                // Add leader (current user)
                RegistrationMember::create([
                    'registration_id' => $registration->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'institution' => auth()->user()->institution,
                    'role' => 'leader',
                ]);

                // Add other members
                foreach ($validated['members'] as $memberData) {
                    RegistrationMember::create([
                        'registration_id' => $registration->id,
                        'name' => $memberData['name'],
                        'email' => $memberData['email'],
                        'phone' => $memberData['phone'] ?? null,
                        'institution' => $memberData['institution'] ?? null,
                        'role' => 'member',
                    ]);
                }
            }

            // Create payment if not free
            if (!$event->is_free) {
                $payment = Payment::create([
                    'registration_id' => $registration->id,
                    'reference' => 'TRX-' . strtoupper(uniqid()),
                    'merchant_ref' => 'SIMEK-' . time() . '-' . $registration->id,
                    'amount' => $event->registration_fee,
                    'fee' => 0,
                    'total_amount' => $event->registration_fee,
                    'status' => 'unpaid',
                    'expired_at' => now()->addHours(24),
                ]);
            }

            // Log activity
            self::logActivity(
                'Registered to event: ' . $event->name,
                'registration',
                Registration::class,
                $registration->id,
                'created'
            );

            DB::commit();

            if ($event->is_free) {
                return redirect()->route('participant.registrations.show', $registration)
                    ->with('success', 'Pendaftaran berhasil! Silakan tunggu konfirmasi dari panitia.');
            } else {
                return redirect()->route('participant.registrations.payment', $registration)
                    ->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Show registration detail.
     */
    public function show(Registration $registration)
    {
        // Check ownership
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        $registration->load([
            'event.requirements',
            'members',
            'payment',
            'attendances.eventSession'
        ]);

        return view('participant.registrations.show', compact('registration'));
    }

    /**
     * Show payment page.
     */
    public function payment(Registration $registration)
    {
        // Check ownership
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        if ($registration->event->is_free) {
            return redirect()->route('participant.registrations.show', $registration)
                ->with('info', 'Event ini gratis, tidak memerlukan pembayaran.');
        }

        $registration->load(['event', 'payment']);

        return view('participant.registrations.payment', compact('registration'));
    }
}