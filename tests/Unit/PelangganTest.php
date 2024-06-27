<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;;
use Illuminate\Support\Facades\Auth;
use lluminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Console\Kernel;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Teknisi;
use App\Models\Antrian;
use App\Models\Kendala;
use App\Models\Konsol;
use Illuminate\Http\UploadedFile;

class PelangganTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function testIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/dashboardpelanggan');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboardpelanggan.layouts.home');
    }

    public function test_isi_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $pelanggan = Pelanggan::factory()->create([
            "nama_pelanggan" => "Yu Narukami",
            "alamat" => "Cimahi",
            "no_telp" => "08123456",
            "email" => "yunarukami@gmail",
        ]);

        $teknisi = Teknisi::factory()->create([
            "nama_teknisi" => "John Doe",
            "no_telp" => "1234567890",
            "alamat" => "Bandung"
        ]);

        $konsol = Konsol::factory()->create([
            "id_pelanggan" => $pelanggan->id_pelanggan,
            "nama_konsol" => "PS5",
            "foto" => UploadedFile::fake()->image('test.jpg'),
        ]);

        $kendala_kerusakan = Kendala::factory()->create([
            "id_konsol" => $konsol->id_konsol,
            "kendala_kerusakan" => "PS nya ga bisa nyala"
        ]);


        $data = [
            "nama_pelanggan" => "Yu Narukami",
            "alamat" => "Cimahi",
            "no_telp" => "08123456",
            "email" => "yunarukami@gmail",
            "nama_konsol" => "PS5",
            "kendala_kerusakan" => "PS nya ga bisa nyala",
            "foto" => UploadedFile::fake()->image('test.jpg'),
            "id_teknisi" => $teknisi->id_teknisi,
            "id_konsol" => $konsol->id_konsol,
            "id_kendala" => $kendala_kerusakan->id_kendala
        ];

        $response = $this->post('/pelanggan/isidata', $data);

        // Periksa apakah data disimpan di database
        $this->assertDatabaseHas('tbl_pelanggan', [
            "nama_pelanggan" => "Yu Narukami",
            "alamat" => "Cimahi",
            "no_telp" => "08123456",
            "email" => "yunarukami@gmail",
        ]);

        $this->assertDatabaseHas('tbl_kendala', [
            'kendala_kerusakan' => 'PS nya ga bisa nyala',
        ]);



        // Periksa apakah redirect ke halaman yang benar
        $response->assertRedirect('/pelanggan/dashboardpelanggan');
        $response->assertSessionHas('success', 'Data kamu sudah di kirim ke teknisi!');

    }


    public function test_profil_toko()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/profilToko');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboardpelanggan.layouts.abouts');

    }

    public function test_status_servis()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/statusservis');

        $response->assertStatus(200);

        $response->assertViewIs('dashboardpelanggan.status_servis.viewstatus_servis');
    }

}
