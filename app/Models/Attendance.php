<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'event_session_id',
        'check_in_at',
        'check_in_by',
        'notes',
    ];

    protected $casts = [
        'check_in_at' => 'datetime',
    ];

    // Relationships
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function eventSession()
    {
        return $this->belongsTo(EventSession::class);
    }

    // Helper Methods
    public function hasCheckedIn()
    {
        return !is_null($this->check_in_at);
    }
}