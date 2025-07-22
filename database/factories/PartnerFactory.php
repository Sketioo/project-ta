<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'logo_path' => 'logos/' . $this->faker->word() . '.png',
            'website_url' => $this->faker->url(),
            'is_visible' => $this->faker->boolean(),
        ];
    }
}
