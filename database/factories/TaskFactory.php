<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->words(2, true);
        $arrayValues = ['open', 'close'];
        $arrayPriority = ['1 - low', '2 - medium', '3- hight'];

        return [
            'user_id' =>  User::factory(),  
            'client_id' => Client::factory(),
            'project_id' => Project::factory(), 
            'title' => ucfirst($title),
            'description' => ucfirst( fake()->paragraphs(2, true) ),
            'priority' => $arrayPriority[rand(0,2)] ,
            'status' => $arrayValues[rand(0,1)],
        ];
    }
}
