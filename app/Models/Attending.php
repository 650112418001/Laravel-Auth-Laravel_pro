<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attending extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'num_register'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
