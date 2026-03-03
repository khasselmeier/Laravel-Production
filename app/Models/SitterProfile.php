<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitterProfile extends Model
{
    protected $fillable = [
        'user_id','experience','allowed_species','vibes','cannot_handle',
        'status','moderation_notes','moderated_at'
    ];

    protected $casts = [
        'allowed_species' => 'array',
        'vibes' => 'array',
        'cannot_handle' => 'array',
        'moderated_at' => 'datetime',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
