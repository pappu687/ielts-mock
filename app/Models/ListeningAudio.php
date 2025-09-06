<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeningAudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'audio_file_path',
        'transcript',
        'duration_seconds',
        'difficulty_level',
        'accent_type',
        'number_of_speakers',
        'context_type',
        'question_count',
     ];
}
