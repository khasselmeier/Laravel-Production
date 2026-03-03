<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetSittingApplication extends Model
{
    protected $fillable = [
        'full_name',
        'experience',
        'availability',
        'preferred_animals',
        'status',
        'moderation_notes',
        'moderated_at',
    ];
}
