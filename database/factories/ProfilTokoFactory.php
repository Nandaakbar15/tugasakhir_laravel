<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelanggan;
use App\Models\Teknisi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilToko>
 */
class ProfilTokoFactory extends Factory
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
            "id_teknisi" => Teknisi::factory(),
            "nama_toko" => $this->faker->company(),
            "deskripsi" => $this->faker->text(),
            "foto" => $this->faker->imageUrl(640, 480),
        ];
    }
}
