<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pelanggan;
use App\Models\Teknisi;
use App\Models\User;
use App\Models\Konsol;
use App\Models\Kendala;
use App\Models\Antrian;
use App\Models\Pembayaran;
use Midtrans\Config;
use Midtrans\Snap;
use Mockery;
use Illuminate\Http\UploadedFile;

class PelangganControllerTest extends TestCase
{
     use RefreshDatabase;

    public function setUp(): void // test ambil key dari midtrans
    {
        parent::setUp();

        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    public function testDashboardPelanggan() // test halaman dashboard pelanggan
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/dashboardpelanggan');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboardpelanggan.layouts.home');
    }

    public function test_isi_data() // test halaman form isi data atau servis
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


    public function test_profil_toko() // test halaman profil toko
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/profilToko');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboardpelanggan.layouts.abouts');

    }

    public function test_status_servis() // test halaman status servis
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/statusservis');

        $response->assertStatus(200);

        $response->assertViewIs('dashboardpelanggan.status_servis.viewstatus_servis');
    }

    public function test_halaman_pembayaran() // test halaman pembayaran
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/pelanggan/pembayaran');

        $response->assertStatus(200);

        $response->assertViewIs('dashboardpelanggan.pembayaran.viewpembayaran');
    }

    public function test_detail_pembayaran()
    {
        // Buat data pelanggan dan antrian
        $pelanggan = Pelanggan::factory()->create();
        $antrian = Antrian::factory()->create(['id_pelanggan' => $pelanggan->id_pelanggan]);
        $pembayaran = Pembayaran::factory()->create(['id_pelanggan' => $pelanggan->id_pelanggan]);

        $response = $this->get(route('checkout', [
            'payment_token' => 'sample_token',
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_antrian' => $antrian->id_antrian,
            'id_pembayaran' => $pembayaran->id_pembayaran,
        ]));

        $response->assertStatus(200)
                 ->assertViewIs('dashboardpelanggan.pembayaran.checkout')
                 ->assertViewHas('payment_token', 'sample_token')
                 ->assertViewHas('pelanggan', $pelanggan)
                 ->assertViewHas('antrian', $antrian)
                 ->assertViewHas('pembayaran', $pembayaran)
                 ->assertViewHas('jumlah_pembayaran', $pembayaran->jumlah_pembayaran);
    }

    public function test_form_pembayaran() // test logic pembayaran dengan midtrans
    {
        // Mock data pelanggan dan antrian
        $pelanggan = Pelanggan::factory()->create();
        $konsol = Konsol::factory()->create(['id_pelanggan' => $pelanggan->id_pelanggan]);
        $antrian = Antrian::factory()->create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_konsol' => $konsol->id_konsol,
        ]);

        // Mock request data
        $requestData = [
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_antrian' => $antrian->id_antrian,
            'nama' => $pelanggan->nama_pelanggan,
            'email' => $pelanggan->email,
            'no_telp' => $pelanggan->no_telp,
            'jumlah_pembayaran' => 100000,
        ];

        // Mock Snap::getSnapToken response
        $snapMock = Mockery::mock('alias:' . Snap::class);
        $snapMock->shouldReceive('getSnapToken')->andReturn('sample_token');

        $response = $this->post('/pelanggan/bayar', $requestData);

        $response->assertStatus(200)
                ->assertViewIs('dashboardpelanggan.pembayaran.checkout')
                ->assertViewHas('payment_token', 'sample_token')
                ->assertViewHas('pelanggan', $pelanggan)
                ->assertViewHas('antrian', $antrian);

        $this->assertDatabaseHas('tbl_pembayaran', [
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'jumlah_pembayaran' => 100000,
            'status' => 'paid'
        ]);
    }
}
