<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->numerify('###########'),
            'whatsapp' => fake()->numerify('###########'),
            'email' => fake()->email(),
            'person_id' => fake()->randomElement(Person::pluck('id')),
        ];
    }
}
