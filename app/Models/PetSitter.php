<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetSitter extends Model
{
    protected $fillable = [
        'name',
        'experience',
        'availability',
        'preferred_animals'
    ];
}
