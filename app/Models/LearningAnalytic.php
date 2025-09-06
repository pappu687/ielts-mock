<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_type',
        'question_type',
        'accuracy_rate',
        'average_time_per_question',
        'common_mistakes',
        'improvement_trends',
        'last_updated',
     ];

    protected $casts = [
        'accuracy_rate'             => 'float',
        'average_time_per_question' => 'float',
        'common_mistakes'           => 'array',
        'improvement_trends'        => 'array',
        'last_updated'              => 'datetime',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}