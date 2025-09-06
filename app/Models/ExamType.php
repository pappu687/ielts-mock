<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'skills_included',
        'pricing_tier',
     ];

    protected $casts = [
        'skills_included' => 'array',
     ];

    public function examSessions(): HasMany
    {
        return $this->hasMany(ExamSession::class);
    }
}
