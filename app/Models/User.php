<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'institution',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Relationships
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function updatedEvents()
    {
        return $this->hasMany(Event::class, 'updated_by');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function posterTemplates()
    {
        return $this->hasMany(PosterTemplate::class, 'created_by');
    }

    // Helper Methods
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function canManageEvents()
    {
        return $this->hasPermissionTo('manage_events') || $this->isSuperAdmin();
    }
    
    public function sendEmailVerificationNotification()
    {
    $this->notify(new \App\Notifications\CustomVerifyEmail);
    }
}