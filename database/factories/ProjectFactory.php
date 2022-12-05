<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $title = fake()->words(1, true);
        $arrayValues = ['open', 'close', 'waiting'];

        return [
            'user_id' =>  User::factory(),  
            'client_id' => Client::factory(), 
            'title' => ucfirst($title),
            'slug' => str_slug($title),
            'description' => fake()->paragraphs(2, true),
            'deadline' => \Carbon\Carbon::createFromDate(2023,01,01)->toDateTimeString(),
            'status' => $arrayValues[rand(0,2)] 
        ];
    }
}
