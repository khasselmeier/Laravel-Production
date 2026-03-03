<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    protected $fillable = ['sitter_profile_id','pet_sitting_request_id','score','reasons'];
    protected $casts = ['reasons' => 'array'];

    public function sitterProfile() { return $this->belongsTo(SitterProfile::class); }
    public function request() { return $this->belongsTo(PetSittingRequest::class, 'pet_sitting_request_id'); }
}
