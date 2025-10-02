<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class TestResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_section_id',
        'type',
        'title',
        'content',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'metadata',
        'order',
        'is_active',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    public function testSection(): BelongsTo
    {
        return $this->belongsTo(TestSection::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        return Storage::url($this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        if (!$this->file_size) {
            return 'Unknown';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function isAudio(): bool
    {
        return $this->type === 'audio';
    }

    public function isPassage(): bool
    {
        return $this->type === 'passage';
    }

    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    public function isPrompt(): bool
    {
        return $this->type === 'prompt';
    }

    public function isTranscript(): bool
    {
        return $this->type === 'transcript';
    }

    // Scope for active resources
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope ordered by order field
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Scope for specific resource type
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
