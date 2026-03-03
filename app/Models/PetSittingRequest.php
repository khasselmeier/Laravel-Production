<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetSittingRequest extends Model
{
    protected $fillable = [
        'user_id','pet_name','species','pet_traits',
        'start_date','end_date','notes',
        'status','moderation_notes','moderated_at'
    ];

    protected $casts = [
        'pet_traits' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'moderated_at' => 'datetime',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
