<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grid_id',
        'attempt',
        'time',
        'is_finished',
        'is_solved',
    ];

    protected $table = 'user_attempts';

    protected $casts = [
        'attempt' => 'array',
        'is_finished' => 'boolean',
        'is_solved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
