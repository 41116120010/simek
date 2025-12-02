<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'name',
        'slug',
        'description',
        'terms_conditions',
        'competition_type',
        'max_team_members',
        'min_team_members',
        'speaker_name',
        'speaker_bio',
        'speaker_photo',
        'venue',
        'venue_address',
        'venue_link',
        'start_date',
        'end_date',
        'quota',
        'registered_count',
        'registration_fee',
        'is_free',
        'registration_start',
        'registration_end',
        'banner',
        'poster',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'registration_fee' => 'decimal:2',
        'is_free' => 'boolean',
    ];

    // Auto generate code & slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->code)) {
                $event->code = 'EVT-' . strtoupper(Str::random(8));
            }
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->name) . '-' . time();
            }
        });

        static::updated(function ($event) {
            // Log activity
            ActivityLog::create([
                'user_id' => auth()->id(),
                'log_name' => 'event',
                'description' => 'Updated event: ' . $event->name,
                'subject_type' => get_class($event),
                'subject_id' => $event->id,
                'event' => 'updated',
            ]);
        });
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }

    public function requirements()
    {
        return $this->hasMany(EventRequirement::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }

    public function scopeCompetition($query)
    {
        return $query->where('type', 'competition');
    }

    public function scopeSeminar($query)
    {
        return $query->where('type', 'seminar');
    }

    public function scopeOpenForRegistration($query)
    {
        return $query->where('registration_start', '<=', now())
                     ->where('registration_end', '>=', now());
    }

    // Helper Methods
    public function isCompetition()
    {
        return $this->type === 'competition';
    }

    public function isSeminar()
    {
        return $this->type === 'seminar';
    }

    public function isFull()
    {
        return $this->quota && $this->registered_count >= $this->quota;
    }

    public function isRegistrationOpen()
    {
        return now()->between($this->registration_start, $this->registration_end);
    }

    public function canRegister()
    {
        return $this->isRegistrationOpen() 
               && !$this->isFull() 
               && $this->status === 'published';
    }

    public function getRemainingQuotaAttribute()
    {
        return $this->quota ? $this->quota - $this->registered_count : null;
    }

    public function incrementRegisteredCount()
    {
        $this->increment('registered_count');
    }

    public function decrementRegisteredCount()
    {
        $this->decrement('registered_count');
    }
}