<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'education_level',
        'ielts_experience',
        'test_date_target',
        'study_goals',
        'preparation_time_per_week',
     ];

    protected $casts = [
        'date_of_birth'    => 'date',
        'test_date_target' => 'date',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
