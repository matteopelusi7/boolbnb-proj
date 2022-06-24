<?php

use App\Add;
use App\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Config::get('apartments');

        $adds = Add::all();
        $addsId = $adds->pluck('id')->all();

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
            $apartments->description = $element['description'];
            $apartments->price = $element['price'];
            $apartments->visible = $element['visible'];
            $apartments->user_id = $element['user_id'];

            $randomInt = $faker->numberBetween(1,5);
            $randomTipologies = $faker->randomElements($addsId,$randomInt);

            $apartments->save();
            $apartments->adds()->attach($randomTipologies);
        }
    }
}
