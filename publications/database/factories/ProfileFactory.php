<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
            'bio' => fake()->text(),
        ];
    }
}

// the factory is a class that will generate fake data for the model for testing purposes
// to create a factory we have to use the command line : php artisan make:factory FactoryName
// the factory class will have a definition() method that will generate the fake data
// to generate the fake data we have to use the factory() function in the seeder class
// to generate the fake data we have to use the create() function in the seeder class