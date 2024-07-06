<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelanggan;
use App\Models\Antrian;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
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
            "id_antrian" => Antrian::factory(),
            "nama" => $this->faker->name(),
            "email" => $this->faker->email(),
            "no_telp" => $this->faker->phoneNumber(),
            "jumlah_pembayaran" => $this->faker->numberBetween(100000, 1000000),
            "tgl_pembayaran" => $this->faker->date(),
            "status" => $this->faker->randomElement(['paid', 'unpaid']),
        ];
    }
}
