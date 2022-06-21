<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email', 
        'text',
        'apartment_id',
    ];

    public function apartments(){
        return $this->belongsTo('App\Apartment');
    }
}
