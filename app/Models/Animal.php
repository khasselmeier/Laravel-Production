<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'type',
        'age',
        'bio',
        'energy_level',
        'zodiac_match'
    ];
}

