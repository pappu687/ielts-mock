<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'duration_minutes',
        'is_active',
        'settings',
        'created_by',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(TestSection::class)->orderBy('order');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getTotalQuestionsAttribute(): int
    {
        return $this->sections()
            ->withCount('questions')
            ->get()
            ->sum('questions_count');
    }

    public function getTotalDurationAttribute(): int
    {
        return $this->sections()->sum('time_limit_minutes') ?? $this->duration_minutes ?? 0;
    }

    // Scope for active tests
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for specific test type
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
