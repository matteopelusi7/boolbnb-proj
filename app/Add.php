<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Add extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }

    public static function getUniqueSlug($name) {
        $slug = Str::slug($name);
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
