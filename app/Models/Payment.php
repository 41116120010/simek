<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'reference',
        'merchant_ref',
        'payment_method',
        'payment_channel',
        'amount',
        'fee',
        'total_amount',
        'status',
        'checkout_url',
        'paid_at',
        'expired_at',
        'payment_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'payment_response' => 'array',
    ];

    // Relationships
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    // Scopes
    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    // Helper Methods
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function isUnpaid()
    {
        return $this->status === 'unpaid';
    }

    public function isExpired()
    {
        return $this->status === 'expired';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Update registration status
        $this->registration->update(['status' => 'paid']);

        // Log activity
        ActivityLog::create([
            'user_id' => $this->registration->user_id,
            'log_name' => 'payment',
            'description' => 'Payment successful for registration: ' . $this->registration->registration_code,
            'subject_type' => get_class($this),
            'subject_id' => $this->id,
            'event' => 'paid',
        ]);
    }
}