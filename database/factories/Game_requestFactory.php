<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game_request;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game_request>
 */
class Game_requestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_game" => $this->faker->name(),
            "developer" => $this->faker->name(),
            "tgl_rilis" => $this->faker->date(),
            "platform" => $this->faker->name(),
            "foto" => $this->faker->imageUrl(640, 480),
        ];
    }
}
