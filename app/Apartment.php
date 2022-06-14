<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title', 
        'number_of_room',
        'number_of_bedroom',
        'number_of_bathroom',
        'sqm',
        'address',
        'cover',
        'visible',
    ];
}
