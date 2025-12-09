<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $skills = ['PHP', 'C#', 'JavaScript', 'Python', 'Java', 'Laravel', 'React', 'Vue', 'MySQL'];
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'), // password
            'seniority' => $this->faker->randomElement(['Jr', 'Pl', 'Sr']),

            // escolhe de 1 a 5 skills aleatórias
            'skills' => $this->faker->randomElements($skills, rand(1, 5)),

            'cep' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->secondaryAddress(),
            'neighborhood' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
        ];
    }
}
