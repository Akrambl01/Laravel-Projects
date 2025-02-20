<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // method 1
        // DB::table("profiles")->insert([
        //     "name" => "Akram",
        //     "email"=> Str::random(10)."@gmail.com",
        //     "password" => Hash::make("password"),
        //     "bio" => Str::random(255),
        // ]);

        // method 2
        Profile::factory(200)->create();

    }
}

// the seeder is a class that will insert data into the database for testing purposes
// to create a seeder we have to use the command line : php artisan make:seeder SeederName
// the seeder class will have a run() method that will insert the data into the database
// to run the seeder we have to use the command line : php artisan db:seed --class=SeederName or php artisan db:seed or php artisan migrate:fresh --seed
