<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];
}
