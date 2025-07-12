<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this ->faker->sentence(3,true),
            'description' =>$this->faker->paragraph(5,true),
            'duration' =>$this->faker->sentence(3,true),
            'mode' =>$this->faker->sentence('3',true),
            'level' =>$this->faker->sentence(3,true)
        ];
    }
}
