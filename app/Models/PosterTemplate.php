<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'file_path',
        'text_positions',
        'category',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'text_positions' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForCompetition($query)
    {
        return $query->where('category', 'competition');
    }

    public function scopeForSeminar($query)
    {
        return $query->where('category', 'seminar');
    }

    // Helper Methods
    public function isActive()
    {
        return $this->is_active;
    }
}