<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedContent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'content',
        'total_tokens'
    ];

    /**
     * User that owns this text.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
