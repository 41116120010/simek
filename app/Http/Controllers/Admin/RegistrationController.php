<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Event;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of registrations - PERMISSION CHECK
     */
    public function index(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('view_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat registrations.');
        }

        $query = Registration::with(['user', 'event', 'payment'])
            ->latest();

        // Filter by event
        if ($request->has('event') && $request->event != '') {
            $query->where('event_id', $request->event);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhere('registration_code', 'like', '%' . $request->search . '%')
              ->orWhere('team_name', 'like', '%' . $request->search . '%');
        }

        $registrations = $query->paginate(15);
        $events = Event::orderBy('name')->get();

        return view('admin.registrations.index', compact('registrations', 'events'));
    }

    /**
     * Display the specified registration - PERMISSION CHECK
     */
    public function show(Registration $registration)
    {
        // Double check permission
        if (!auth()->user()->can('view_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat detail registration.');
        }

        $registration->load([
            'user',
            'event.requirements',
            'members',
            'payment',
            'attendances.eventSession'
        ]);

        return view('admin.registrations.show', compact('registration'));
    }

    /**
     * Approve registration - PERMISSION CHECK
     */
    public function approve(Registration $registration)
    {
        // Double check permission
        if (!auth()->user()->can('approve_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk approve registration.');
        }

        try {
            $registration->confirm();

            self::logActivity(
                'Approved registration: ' . $registration->registration_code,
                'registration',
                Registration::class,
                $registration->id,
                'approved'
            );

            return back()->with('success', 'Registrasi berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengkonfirmasi registrasi: ' . $e->getMessage());
        }
    }

    /**
     * Reject/Cancel registration - PERMISSION CHECK
     */
    public function reject(Registration $registration)
    {
        // Double check permission
        if (!auth()->user()->can('reject_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk reject registration.');
        }

        try {
            $registration->update(['status' => 'cancelled']);

            self::logActivity(
                'Rejected registration: ' . $registration->registration_code,
                'registration',
                Registration::class,
                $registration->id,
                'rejected'
            );

            return back()->with('success', 'Registrasi berhasil ditolak!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak registrasi: ' . $e->getMessage());
        }
    }

    /**
     * Export registrations to Excel - PERMISSION CHECK
     */
    public function exportExcel(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('export_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk export registrations.');
        }

        $query = Registration::with(['user', 'event', 'members']);

        // Apply same filters as index
        if ($request->has('event') && $request->event != '') {
            $query->where('event_id', $request->event);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $registrations = $query->get();

        // Create export class
        return Excel::download(new \App\Exports\RegistrationsExport($registrations), 'registrations_' . now()->format('Y-m-d_His') . '.xlsx');
    }

    /**
     * Export registrations to PDF - PERMISSION CHECK
     */
    public function exportPdf(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('export_registrations')) {
            abort(403, 'Anda tidak memiliki izin untuk export registrations.');
        }

        $query = Registration::with(['user', 'event', 'members']);

        if ($request->has('event') && $request->event != '') {
            $query->where('event_id', $request->event);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $registrations = $query->get();

        $pdf = Pdf::loadView('admin.registrations.pdf', compact('registrations'));
        return $pdf->download('registrations_' . now()->format('Y-m-d_His') . '.pdf');
    }
}