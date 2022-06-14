<?php

use App\Add;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class AddSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adds = Config::get('adds');

        foreach ( $adds as $el ) {
            $adds = new Add();

            $adds->name = $el['name'];

            $adds->save();
        }
    }
}
