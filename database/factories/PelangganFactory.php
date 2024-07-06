<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_pelanggan" => $this->faker->name(),
            "alamat" => $this->faker->address(),
            "no_telp" => $this->faker->phoneNumber(),
            "email" => $this->faker->email()
        ];
    }
}
