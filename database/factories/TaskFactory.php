<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status_id' => $this->faker->randomElement([1, 2]), // Genera status_id aleatorio entre 1 y 2
            'user_id' => \App\Models\User::factory()->create()->id, // Ejemplo de relación con usuario
        ];
    }
}