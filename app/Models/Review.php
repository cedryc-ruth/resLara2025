<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'show_id',
        'review',
        'stars',
        'validated',
    ];

    protected $table = 'reviews';

    public $timestamps = true;

    /**
     * Get the user author of the review
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the show related by the review
     */
    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }
}
