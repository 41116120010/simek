<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of available events.
     */
    public function index(Request $request)
    {
        $query = Event::where('status', 'published')
            ->where('registration_end', '>=', now())
            ->with('creator')
            ->withCount('registrations');

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by price
        if ($request->has('price')) {
            if ($request->price === 'free') {
                $query->where('is_free', true);
            } elseif ($request->price === 'paid') {
                $query->where('is_free', false);
            }
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'date':
                $query->orderBy('start_date');
                break;
            default:
                $query->latest();
        }

        $events = $query->paginate(12);

        return view('participant.events.index', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        // Check if event is accessible
        if ($event->status !== 'published') {
            abort(404);
        }

        $event->load([
            'creator',
            'sessions' => fn($q) => $q->orderBy('start_time'),
            'requirements' => fn($q) => $q->orderBy('order'),
        ]);

        // Check if user already registered
        $userRegistration = null;
        if (auth()->check()) {
            $userRegistration = $event->registrations()
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('participant.events.show', compact('event', 'userRegistration'));
    }
}