<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'name',
        'email',
        'phone',
        'institution',
        'student_id',
        'role',
    ];

    // Relationships
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    // Helper Methods
    public function isLeader()
    {
        return $this->role === 'leader';
    }

    public function isMember()
    {
        return $this->role === 'member';
    }
}