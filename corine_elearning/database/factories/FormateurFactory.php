<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\formateur>
 */
class FormateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $faker->lastName,
            'prenom' => $faker->firstName,
            'naissance' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'cni' => $faker->randomDigit(5),
            'ville' => $faker->lastName,
            'quartier' => $faker->firstName,
            'tel' => $faker->randomDigit(7),
            'email' => fake()->unique()->safeEmail(),
            'password' => $faker->lastName,
            'photo' => $faker->file($sourceDir = 'storage/app/public/photos', $targetDir = 'public/photos', true),
            
            // Ajoutez d'autres attributs si nécessaire
        ];
    }
}
