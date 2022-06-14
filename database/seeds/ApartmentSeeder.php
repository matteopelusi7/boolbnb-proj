<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Config::get('apartments');

        foreach ($apartments as $element) {
            $apartments = new Apartment();

            $apartments->title = $element['title'];
            $apartments->slug = Str::slug($element['title']);
            $apartments->number_of_room = $element['number_of_room'];
            $apartments->number_of_bedroom = $element['number_of_bedroom'];
            $apartments->number_of_bathroom = $element['number_of_bathroom'];
            $apartments->sqm = $element['sqm'];
            $apartments->address = $element['address'];
            $apartments->cover = $element['cover'];
            $apartments->visible = $element['visible'];

            $apartments->save();
        }
    }
}
