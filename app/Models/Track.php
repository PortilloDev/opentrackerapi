<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'user_id',
        'distance',
        'time',
        'description'
    ];

    /**
     * Get the user that owns the track.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
