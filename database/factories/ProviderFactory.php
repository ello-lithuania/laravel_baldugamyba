<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\RoleEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProviderFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'description' => fake()->text(),
            'city' => fake()->city(),
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'user_id' => \App\Models\User::factory()->customRole('provider')->create(),
        ];
    }
}


