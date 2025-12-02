<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Data berbeda berdasarkan role
        if ($user->hasRole('super_admin') || $user->hasRole('event_manager')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('finance')) {
            return $this->financeDashboard();
        } elseif ($user->hasRole('committee')) {
            return $this->committeeDashboard();
        } else {
            return $this->participantDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'published')->count(),
            'total_registrations' => Registration::count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
        ];

        $recentEvents = Event::with('creator')
            ->latest()
            ->take(5)
            ->get();

        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentEvents', 'recentRegistrations'));
    }

    private function financeDashboard()
    {
        $stats = [
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_payments' => Payment::where('status', 'unpaid')->count(),
            'paid_registrations' => Registration::where('status', 'paid')->count(),
        ];

        $recentPayments = Payment::with(['registration.user', 'registration.event'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.finance', compact('stats', 'recentPayments'));
    }

    private function committeeDashboard()
    {
        $stats = [
            'upcoming_events' => Event::where('start_date', '>', now())->count(),
            'today_events' => Event::whereDate('start_date', today())->count(),
            'total_participants' => Registration::where('status', 'confirmed')->count(),
        ];

        $upcomingEvents = Event::where('start_date', '>', now())
            ->orderBy('start_date')
            ->take(5)
            ->get();

        return view('dashboard.committee', compact('stats', 'upcomingEvents'));
    }

    private function participantDashboard()
    {
        $user = auth()->user();

        $myRegistrations = Registration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $availableEvents = Event::where('status', 'published')
            ->where('registration_end', '>=', now())
            ->whereDoesntHave('registrations', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard.participant', compact('myRegistrations', 'availableEvents'));
    }
}