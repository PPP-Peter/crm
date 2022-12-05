<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'Company' => ucfirst(fake()->words(2, true)),
            'Address' => ucfirst(fake()->address()),
            'VAT' => rand(1000,1000000) 
        ];
    }
}
