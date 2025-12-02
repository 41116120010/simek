<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration_code',
        'event_id',
        'user_id',
        'team_name',
        'requirement_answers',
        'notes',
        'status',
        'confirmed_at',
        'attended_at',
    ];

    protected $casts = [
        'requirement_answers' => 'array',
        'confirmed_at' => 'datetime',
        'attended_at' => 'datetime',
    ];

    // Auto generate code
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            if (empty($registration->registration_code)) {
                $registration->registration_code = 'REG-' . strtoupper(Str::random(10));
            }
        });

        static::created(function ($registration) {
            // Increment event registered count
            $registration->event->incrementRegisteredCount();

            // Log activity
            ActivityLog::create([
                'user_id' => $registration->user_id,
                'log_name' => 'registration',
                'description' => 'Registered to event: ' . $registration->event->name,
                'subject_type' => get_class($registration),
                'subject_id' => $registration->id,
                'event' => 'created',
            ]);
        });

        static::deleted(function ($registration) {
            // Decrement event registered count
            $registration->event->decrementRegisteredCount();
        });
    }

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(RegistrationMember::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeWaitingPayment($query)
    {
        return $query->where('status', 'waiting_payment');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeAttended($query)
    {
        return $query->where('status', 'attended');
    }

    // Helper Methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isWaitingPayment()
    {
        return $this->status === 'waiting_payment';
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function hasAttended()
    {
        return $this->status === 'attended';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function needsPayment()
    {
        return !$this->event->is_free && $this->status === 'waiting_payment';
    }

    public function confirm()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    public function markAsAttended()
    {
        $this->update([
            'status' => 'attended',
            'attended_at' => now(),
        ]);
    }
}