<?php

use Illuminate\Support\Facades\Config;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = Config::get('users');

        foreach ( $users as $utente ) {
            $user = new User();

            $user->name = $utente['name'];
            $user->surname = $utente['surname'];
            $user->slug = Str::slug($utente['surname']);
            $user->email = $utente['email'];
            $user->password = Hash::make($utente['password']);;
            $user->date_of_birth = $utente['date_of_birth'];

            $user->save();
        }

    }
}
