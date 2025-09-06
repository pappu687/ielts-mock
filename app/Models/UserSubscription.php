<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_type',
        'status',
        'starts_at',
        'expires_at',
        'payment_method',
        'auto_renewal',
        'features',
     ];

    protected $casts = [
        'starts_at'    => 'datetime',
        'expires_at'   => 'datetime',
        'auto_renewal' => 'boolean',
        'features'     => 'array',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
