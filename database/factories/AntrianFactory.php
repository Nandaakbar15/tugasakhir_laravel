<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Antrian;
use App\Models\Pelanggan;
use App\Models\Konsol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Antrian>
 */
class AntrianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_konsol' => Konsol::factory(),
            'id_pelanggan' => Pelanggan::factory(),
            'nama_pelanggan' => $this->faker->name(),
            'no_antrian' => $this->faker->unique()->numberBetween(1000, 9999),
            'email' => $this->faker->email(),
            'tgl_servis' => $this->faker->date(),
            'status_servis' => $this->faker->randomElement(['belum selesai', 'sudah selesai']),
        ];
    }
}
