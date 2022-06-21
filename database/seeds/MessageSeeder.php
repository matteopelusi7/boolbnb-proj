<?php

use App\Apartment;
use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        $apartmentsId = $apartments->pluck('id')->all();

        for ($i=0; $i < 100; $i++) {

            $new_message = new Message();

            $new_message->email = $faker->email;
            $new_message->text = $faker->text(300);
            $new_message->apartment_id = $faker->randomElement( $apartmentsId );

            $new_message->save();
        }
    }
}
