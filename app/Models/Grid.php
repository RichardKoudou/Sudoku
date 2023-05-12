<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grid extends Model
{
    use HasFactory;

    protected $fillable = [
        'grid',
        'solution',
        'difficulty',
    ];

    protected $casts = [
        'grid' => 'array',
        'solution' => 'array',
    ];

    public function attempts(): HasMany
    {
        return $this->hasMany(UserAttempt::class);
    }
}
