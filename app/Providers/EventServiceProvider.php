<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Listen to user model updates
        \App\Models\User::updated(function ($user) {
            // If user status changed to inactive and user is currently logged in
            if ($user->isDirty('status') && $user->status === 'inactive') {
                // Check if this is the currently authenticated user
                if (Auth::check() && Auth::id() === $user->id) {
                    Auth::logout();
                    request()->session()->invalidate();
                    request()->session()->regenerateToken();
                }
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}