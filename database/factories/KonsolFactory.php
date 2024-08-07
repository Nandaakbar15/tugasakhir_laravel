<?php

namespace Database\Factories;

use App\Models\Konsol;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelanggan;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Konsol>
 */
class KonsolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_pelanggan" => Pelanggan::factory(),
            "nama_konsol" => $this->faker->name(),
            "foto" => $this->faker->imageUrl(640, 480),
        ];
    }
}
