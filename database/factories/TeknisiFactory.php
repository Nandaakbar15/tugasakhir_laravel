<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teknisi>
 */
class TeknisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_teknisi" => $this->faker->name(),
            "alamat" => $this->faker->address(),
            "no_telp" => $this->faker->phoneNumber()
        ];
    }
}
