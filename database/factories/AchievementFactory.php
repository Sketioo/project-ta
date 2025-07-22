<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'nim' => $this->faker->unique()->numerify('##########'), // Example NIM
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'class' => $this->faker->randomElement(['A', 'B', 'C']),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'file_path' => null, // Can be null
            'is_accepted' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(['pending', 'validated', 'rejected']),
            'validated_by' => null, // Can be null
            'validated_at' => null, // Can be null
            'show_on_main_page' => $this->faker->boolean(),
            'photo_path' => null,
        ];
    }
}
