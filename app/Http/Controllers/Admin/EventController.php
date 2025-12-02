<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSession;
use App\Models\EventRequirement;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Exports\EventsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    use ActivityLogger;

    /**
     * Export Excel - PERMISSION CHECK
     */
    public function exportExcel()
    {
        // Double check permission (middleware + controller)
        if (!auth()->user()->can('export_events')) {
            abort(403, 'Anda tidak memiliki izin untuk export events.');
        }

        return Excel::download(new EventsExport, 'events-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export PDF - PERMISSION CHECK
     */
    public function exportPdf()
    {
        // Double check permission
        if (!auth()->user()->can('export_events')) {
            abort(403, 'Anda tidak memiliki izin untuk export events.');
        }

        $events = Event::with('registrations')
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('code', 'like', '%' . request('search') . '%');
            })
            ->when(request('type'), function($query) {
                $query->where('type', request('type'));
            })
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->withCount('registrations')
            ->latest()
            ->get();

        $pdf = PDF::loadView('admin.events.pdf', compact('events'));
        return $pdf->download('events-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display a listing of events - PERMISSION CHECK
     */
    public function index(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('view_events')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat events.');
        }

        $query = Event::with('creator')
            ->withCount('registrations')
            ->latest();

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        $events = $query->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event - PERMISSION CHECK
     */
    public function create()
    {
        // Double check permission
        if (!auth()->user()->can('create_events')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat event.');
        }

        return view('admin.events.create');
    }

    /**
     * Store a newly created event - PERMISSION CHECK
     */
    public function store(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('create_events')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat event.');
        }

        $validated = $request->validate([
            'type' => 'required|in:competition,seminar',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'terms_conditions' => 'nullable|string',
            
            // Competition specific
            'competition_type' => 'required_if:type,competition|nullable|in:individual,team,both',
            'max_team_members' => 'required_if:competition_type,team,both|nullable|integer|min:1',
            'min_team_members' => 'required_if:competition_type,team,both|nullable|integer|min:1',
            
            // Seminar specific
            'speaker_name' => 'required_if:type,seminar|nullable|string|max:255',
            'speaker_bio' => 'nullable|string',
            
            // Location & Time
            'venue' => 'required|string|max:255',
            'venue_address' => 'nullable|string',
            'venue_link' => 'nullable|url',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            
            // Registration
            'quota' => 'nullable|integer|min:1',
            'registration_fee' => 'required|numeric|min:0',
            'is_free' => 'boolean',
            'registration_start' => 'required|date|before:start_date',
            'registration_end' => 'required|date|after:registration_start|before:start_date',
            
            // Status
            'status' => 'required|in:draft,published',
            
            // Sessions (array)
            'sessions' => 'nullable|array',
            'sessions.*.name' => 'required|string|max:255',
            'sessions.*.description' => 'nullable|string',
            'sessions.*.start_time' => 'required|date',
            'sessions.*.end_time' => 'required|date|after:sessions.*.start_time',
            'sessions.*.location' => 'nullable|string|max:255',
            
            // Requirements (array)
            'requirements' => 'nullable|array',
            'requirements.*.name' => 'required|string|max:255',
            'requirements.*.description' => 'nullable|string',
            'requirements.*.type' => 'required|in:text,file,link',
            'requirements.*.is_required' => 'boolean',
        ], [
            'type.required' => 'Tipe event wajib dipilih.',
            'name.required' => 'Nama event wajib diisi.',
            'description.required' => 'Deskripsi event wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.after' => 'Tanggal mulai harus setelah hari ini.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'registration_start.required' => 'Tanggal mulai pendaftaran wajib diisi.',
            'registration_end.required' => 'Tanggal akhir pendaftaran wajib diisi.',
            'registration_end.before' => 'Tanggal akhir pendaftaran harus sebelum event dimulai.',
        ]);

        DB::beginTransaction();
        try {
            // Set is_free based on registration_fee
            $validated['is_free'] = $validated['registration_fee'] == 0;
            
            // Set created_by & updated_by
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();

            // Create event
            $event = Event::create($validated);

            // Create sessions if provided
            if ($request->has('sessions') && is_array($request->sessions)) {
                foreach ($request->sessions as $index => $sessionData) {
                    EventSession::create([
                        'event_id' => $event->id,
                        'name' => $sessionData['name'],
                        'description' => $sessionData['description'] ?? null,
                        'start_time' => $sessionData['start_time'],
                        'end_time' => $sessionData['end_time'],
                        'location' => $sessionData['location'] ?? $event->venue,
                        'status' => 'scheduled',
                    ]);
                }
            }

            // Create requirements if provided
            if ($request->has('requirements') && is_array($request->requirements)) {
                foreach ($request->requirements as $index => $reqData) {
                    EventRequirement::create([
                        'event_id' => $event->id,
                        'name' => $reqData['name'],
                        'description' => $reqData['description'] ?? null,
                        'type' => $reqData['type'],
                        'is_required' => $reqData['is_required'] ?? true,
                        'order' => $index + 1,
                    ]);
                }
            }

            // Log activity
            self::logActivity(
                'Created event: ' . $event->name,
                'event',
                Event::class,
                $event->id,
                'created'
            );

            DB::commit();

            return redirect()->route('admin.events.index')
                ->with('success', 'Event berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal membuat event: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified event - PERMISSION CHECK
     */
    public function show(Event $event)
    {
        // Double check permission
        if (!auth()->user()->can('view_events')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat detail event.');
        }

        $event->load([
            'creator',
            'sessions' => fn($q) => $q->orderBy('start_time'),
            'requirements' => fn($q) => $q->orderBy('order'),
            'registrations' => fn($q) => $q->with('user')->latest(),
        ])
        ->loadCount('registrations');

        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing - PERMISSION CHECK
     */
    public function edit(Event $event)
    {
        // Double check permission
        if (!auth()->user()->can('edit_events')) {
            abort(403, 'Anda tidak memiliki izin untuk edit event.');
        }

        $event->load(['sessions', 'requirements' => fn($q) => $q->orderBy('order')]);
        
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event - PERMISSION CHECK
     */
    public function update(Request $request, Event $event)
    {
        // Double check permission
        if (!auth()->user()->can('edit_events')) {
            abort(403, 'Anda tidak memiliki izin untuk update event.');
        }

        $validated = $request->validate([
            'type' => 'required|in:competition,seminar',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'terms_conditions' => 'nullable|string',
            
            'competition_type' => 'required_if:type,competition|nullable|in:individual,team,both',
            'max_team_members' => 'required_if:competition_type,team,both|nullable|integer|min:1',
            'min_team_members' => 'required_if:competition_type,team,both|nullable|integer|min:1',
            
            'speaker_name' => 'required_if:type,seminar|nullable|string|max:255',
            'speaker_bio' => 'nullable|string',
            
            'venue' => 'required|string|max:255',
            'venue_address' => 'nullable|string',
            'venue_link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            
            'quota' => 'nullable|integer|min:1',
            'registration_fee' => 'required|numeric|min:0',
            'is_free' => 'boolean',
            'registration_start' => 'required|date|before:start_date',
            'registration_end' => 'required|date|after:registration_start|before:start_date',
            
            'status' => 'required|in:draft,published,ongoing,completed,cancelled',
        ]);

        DB::beginTransaction();
        try {
            $validated['is_free'] = $validated['registration_fee'] == 0;
            $validated['updated_by'] = auth()->id();

            $event->update($validated);

            // Log activity
            self::logActivity(
                'Updated event: ' . $event->name,
                'event',
                Event::class,
                $event->id,
                'updated'
            );

            DB::commit();

            return redirect()->route('admin.events.show', $event)
                ->with('success', 'Event berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal mengupdate event: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified event - PERMISSION CHECK
     */
    public function destroy(Event $event)
    {
        // Double check permission
        if (!auth()->user()->can('delete_events')) {
            abort(403, 'Anda tidak memiliki izin untuk delete event.');
        }

        try {
            // Check if event has registrations
            if ($event->registrations()->count() > 0) {
                return back()->with('error', 'Event tidak dapat dihapus karena sudah memiliki registrasi!');
            }

            $eventName = $event->name;
            
            // Log activity before delete
            self::logActivity(
                'Deleted event: ' . $eventName,
                'event',
                Event::class,
                $event->id,
                'deleted'
            );

            $event->delete();

            return redirect()->route('admin.events.index')
                ->with('success', 'Event berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus event: ' . $e->getMessage());
        }
    }
}