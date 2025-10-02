<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'name',
        'description',
        'order',
        'time_limit_minutes',
        'instructions',
        'is_active',
    ];

    protected $casts = [
        'instructions' => 'array',
        'is_active' => 'boolean',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(TestResource::class)->orderBy('order');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function getAudioResourceAttribute(): ?TestResource
    {
        return $this->resources()->where('type', 'audio')->first();
    }

    public function getPassageResourceAttribute(): ?TestResource
    {
        return $this->resources()->where('type', 'passage')->first();
    }

    public function getImageResourceAttribute(): ?TestResource
    {
        return $this->resources()->where('type', 'image')->first();
    }

    public function getPromptResourceAttribute(): ?TestResource
    {
        return $this->resources()->where('type', 'prompt')->first();
    }

    // Scope for active sections
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope ordered by order field
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
