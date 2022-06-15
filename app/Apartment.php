<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    protected $fillable = [
        'title', 
        'slug',
        'number_of_room',
        'number_of_bedroom',
        'number_of_bathroom',
        'sqm',
        'address',
        'cover',
        'visible',
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function adds() {
        return $this->belongsToMany('App\Add')->withPivot('add_id', 'apartment_id');
    }

    public static function getUniqueSlug($title) {
        $slug = Str::slug($title);
        $slug_base = $slug;
        
        $counter = 1;

        $user_present = User::where('slug',$slug)->first();
        
        while ($user_present) {
            $slug = $slug_base . '-' . $counter;
            $counter++;
            $user_present = User::where('slug',$slug)->first();
        }

        return $slug;
    }
}
