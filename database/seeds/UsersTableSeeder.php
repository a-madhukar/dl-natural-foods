<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if(env('APP_ENV') == "local")
        {
            factory(User::class)->create([
                'name' => "Ajay", 
                'email' => "a.madhukar@yahoo.com", 
                'password' => bcrypt('123456')
            ]); 
        }

    }
}
