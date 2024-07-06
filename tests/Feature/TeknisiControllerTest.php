<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pelanggan;
use App\Models\Antrian;
use App\Models\Teknisi;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\ProfilToko;
use App\Models\Game_request;
use Database\Factories\GameRequestFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TeknisiControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat pengguna admin untuk pengujian
        $User = User::factory()->create([
            'name' => 'admin123',
            'email' => 'admin123@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $this->actingAs($User);
    }

    public function test_halaman_dashboard_teknisi()
    {
        $response = $this->get('/dashboard');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.layouts.home');
    }

    public function test_halaman_data_user()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $pelanggan = Pelanggan::factory()->create();
        $teknisi = Teknisi::factory()->create();

        $response = $this->get('/datauser');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.datauser.viewdatauser')
                 ->assertViewHas('pelanggan', function ($pelanggan) {
                     return $pelanggan->count() > 0;
                 })
                 ->assertViewHas('teknisi', function ($teknisi) {
                     return $teknisi->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }

    public function test_halaman_tambah_teknisi()
    {
        $response = $this->get('/tambahTeknisi');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.datauser.tambahTeknisi');
    }

    public function test_halaman_ubah_teknisi()
    {
        $teknisi = Teknisi::factory()->create();

        // Simulasikan permintaan ke route edit teknisi dengan ID teknisi yang dibuat
        $response = $this->get('/ubah_teknisi/' . $teknisi->id_teknisi);

        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.datauser.ubahDataTeknisi');
    }

    public function test_halaman_ubah_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create();

        // Simulasikan permintaan ke route edit pelanggan dengan ID pelanggan yang dibuat
        $response = $this->get('/ubahdata_pelanggan/' . $pelanggan->id_pelanggan);

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.datauser.ubahDataPelanggan');
    }

    /**
     * Test Case CRUD tabel Teknisi
    */
    public function test_tambah_teknisi()
    {
        // Data teknisi yang akan ditambahkan
        $data = [
            'nama_teknisi' => 'Jane Smith',
            'alamat' => 'Jl. Contoh No. 123',
            'no_telp' => '08123456789'
        ];

        // Mengirimkan request untuk menambahkan teknisi
        $response = $this->post('/tambahTeknisi', $data);

        // Memastikan response redirect (302) ke halaman yang diharapkan
        $response->assertStatus(302);

        // Memastikan data teknisi tersimpan dalam basis data
        $this->assertDatabaseHas('tbl_teknisi', $data);
    }

    public function test_ubah_teknisi()
    {
        $teknisi = Teknisi::factory()->create([
            'nama_teknisi' => 'Old Name',
            'alamat' => 'Old Address',
            'no_telp' => '123456789',
        ]);

        $response = $this->put('/ubah_teknisi/' . $teknisi->id_teknisi, [ // Mengirimkan permintaan PUT untuk mengupdate data pelanggan
            'nama_teknisi' => 'New Name',
            'alamat' => 'New Address',
            'no_telp' => '987654321',
            'email' => 'new@example.com',
        ]);

        $response->assertRedirect('/dashboard'); // Memastikan redirect sesuai dengan yang diharapkan
        $response->assertSessionHas('success', 'Data Teknisi berhasil di ubah!'); // Memastikan pesan sukses

        $this->assertDatabaseHas('tbl_teknisi', [ // Memastikan data dalam database sudah terupdate
            'id_teknisi' => $teknisi->id_teknisi,
            'nama_teknisi' => 'New Name',
            'alamat' => 'New Address',
            'no_telp' => '987654321',
        ]);
    }

    public function test_hapus_teknisi()
    {
        $teknisi = Teknisi::factory()->create();

        $response = $this->delete('/hapusTeknisi/' . $teknisi->id_teknisi);

        $response->assertStatus(302); // Redirect setelah menghapus
        $this->assertDatabaseMissing('tbl_teknisi', [
            'id_teknisi' => $teknisi->id_pelanggan
        ]);
    }

    /**
     * Test Case Ubah dan hapus tabel Pelanggan
     */

    public function test_ubah_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create([
            'nama_pelanggan' => 'Old Name',
            'alamat' => 'Old Address',
            'no_telp' => '123456789',
            'email' => 'old@example.com',
        ]);

        $response = $this->put('/ubahdata_pelanggan/' . $pelanggan->id_pelanggan, [ // Mengirimkan permintaan PUT untuk mengupdate data pelanggan
            'nama_pelanggan' => 'New Name',
            'alamat' => 'New Address',
            'no_telp' => '987654321',
            'email' => 'new@example.com',
        ]);

        $response->assertRedirect('/dashboard'); // Memastikan redirect sesuai dengan yang diharapkan
        $response->assertSessionHas('success', 'Data Pelanggan berhasil di ubah!'); // Memastikan pesan sukses

        $this->assertDatabaseHas('tbl_pelanggan', [ // Memastikan data dalam database sudah terupdate
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'nama_pelanggan' => 'New Name',
            'alamat' => 'New Address',
            'no_telp' => '987654321',
            'email' => 'new@example.com',
        ]);
    }

    public function test_hapus_pelanggan()
    {
        // Buat pelanggan
        $pelanggan = Pelanggan::factory()->create();

        // Buat antrian yang terkait dengan pelanggan
        $antrian = Antrian::factory()->create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
        ]);

        // Mengirimkan permintaan DELETE untuk menghapus pelanggan
        $response = $this->delete('/hapusPelanggan/' . $pelanggan->id_pelanggan);

        // Memastikan response redirect ke halaman yang diharapkan
        $response->assertRedirect('/datauser');

        // Memastikan pesan sukses tersimpan dalam sesi
        $response->assertSessionHas('success', 'Data Pelanggan Berhasil di hapus!');

        // Memastikan antrian yang terkait dengan pelanggan sudah dihapus
        $this->assertDatabaseMissing('tbl_antrian', [
            'id_pelanggan' => $pelanggan->id_pelanggan,
        ]);

        // Memastikan pelanggan sudah dihapus dari basis data
        $this->assertDatabaseMissing('tbl_pelanggan', [
            'id_pelanggan' => $pelanggan->id_pelanggan,
        ]);
    }

    public function test_halaman_status_servis()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $antrian = Antrian::factory()->create();

        $response = $this->get('/status_servis');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.statusservis.viewstatusservis')
                 ->assertViewHas('antrian', function ($antrian) {
                     return $antrian->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }

    public function test_halaman_ubah_statusservis()
    {
        $antrian = Antrian::factory()->create();

        // Simulasikan permintaan ke route edit pelanggan dengan ID pelanggan yang dibuat
        $response = $this->get('/ubahstatus_servis/' . $antrian->id_antrian);

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.statusservis.ubahstatus');
    }

    public function test_ubah_status_servis()
    {
        $antrian = Antrian::factory()->create([
            'status_servis' => 'belum selesai',
        ]);

        $response = $this->put('/ubahstatus_servis/' . $antrian->id_antrian, [ // Mengirimkan permintaan PUT untuk mengupdate status servis
            'status_servis' => 'sudah selesai',
        ]);

        $response->assertRedirect('/dashboard'); // Memastikan redirect sesuai dengan yang diharapkan
        $response->assertSessionHas('success', 'Status Servis Berhasil diubah!'); // Memastikan pesan sukses

        $this->assertDatabaseHas('tbl_antrian', [ // Memastikan data dalam database sudah terupdate
            'id_antrian' => $antrian->id_antrian,
            'status_servis' => 'sudah selesai',
        ]);
    }

    public function test_halaman_status_pembayaran()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $pembayaran = Pembayaran::factory()->create();

        $response = $this->get('/status_pembayaran');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.statuspembayaran.viewstatuspembayaran')
                 ->assertViewHas('pembayaran', function ($pembayaran) {
                     return $pembayaran->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }
    public function test_halaman_kelola_profil_toko()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $profilToko = ProfilToko::factory()->create();

        $response = $this->get('/kelolaprofiltoko');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.kelolaprofiltoko.kelolaprofiltoko')
                 ->assertViewHas('profilToko', function ($profilToko) {
                     return $profilToko->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }

    public function test_halaman_data_game()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $game = Game_request::factory()->create();

        $response = $this->get('/datagame');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.datagame.viewdatagame')
                 ->assertViewHas('game', function ($game) {
                     return $game->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }

    public function test_halaman_tambah_game()
    {
        $response = $this->get('/tambahgame');

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.datagame.tambah');
    }

    public function test_halaman_ubah_data_game()
    {
        $game = Game_request::factory()->create();

        // Simulasikan permintaan ke route edit pelanggan dengan ID pelanggan yang dibuat
        $response = $this->get('/ubahGame/' . $game->id_game);

        // Periksa apakah status respons adalah 200 (OK)
        $response->assertStatus(200);

        // Periksa apakah view yang benar dikembalikan
        $response->assertViewIs('dashboard.datagame.ubah');
    }

    /**
     * Test Case CRUD Tabel Data Game
     */
    public function test_tambah_game()
    {
        // Data game yang akan ditambahkan
        $data = [
            'nama_game' => 'Persona 3',
            'developer' => 'ATLUS',
            'tgl_rilis' =>  '2020-01-01',
            'platform'  => 'PS2',
            'foto' => UploadedFile::fake()->image('test.jpg'),
        ];

        // Mengirimkan request untuk menambahkan game
        $response = $this->post('/tambahgame', $data);

        // Memastikan response redirect (302) ke halaman yang diharapkan
        $response->assertStatus(302);

        // Memastikan data game tersimpan dalam basis data
        unset($data['foto']); // Remove the file from the data array
        $this->assertDatabaseHas('tbl_game_request', [
            'nama_game' => 'Persona 3',
            'developer' => 'ATLUS',
            'tgl_rilis' => '2020-01-01',
            'platform' => 'PS2',
        ]);
    }

    public function test_ubah_game()
    {
       $game = Game_request::factory()->create([
            'nama_game' => 'Old Game',
            'developer' => 'ATLUS',
            'tgl_rilis' => '2020-01-01',
            'platform' => 'PS2',
            'foto' => UploadedFile::fake()->image('test.jpg'),
        ]);

        $response = $this->put('/ubahGame/' . $game->id_game, [ // Mengirimkan permintaan PUT untuk mengupdate data pelanggan
            'nama_game' => 'New Name',
            'developer' => 'new developer',
            'tgl_rilis' => '2018-02-01',
            'platform' => 'PS3',
            'foto' => UploadedFile::fake()->image('test.jpg'),
        ]);

        $response->assertRedirect('/dashboard'); // Memastikan redirect sesuai dengan yang diharapkan
        $response->assertSessionHas('success', 'Data Game berhasil di ubah!'); // Memastikan pesan sukses

        $this->assertDatabaseHas('tbl_game_request', [ // Memastikan data dalam database sudah terupdate
            'id_game' => $game->id_game,
            'nama_game' => 'New Name',
            'developer' => 'new developer',
            'tgl_rilis' => '2018-02-01',
            'platform' => 'PS3',
        ]);
    }

    public function test_hapus_data_game()
    {
        $game = Game_request::factory()->create();

        $response = $this->delete('/hapusGame/' . $game->id_game);

        $response->assertStatus(302); // Redirect setelah menghapus
        $this->assertDatabaseMissing('tbl_game_request', [
            'id_game' => $game->id_game
        ]);
    }

    /**
     * Test Case Halaman Laporan Servis dan cari data laporan servis
     */

    public function test_halaman_laporan_servis()
    {
        // Membuat beberapa data pelanggan dan teknisi
        $pelanggan = Pelanggan::factory()->create();
        $antrian = Antrian::factory()->create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tgl_servis' => now()->toDateString(),
        ]);

        $response = $this->get('/datalaporanservis');

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.datalaporanservis.viewlaporanservis')
                 ->assertViewHas('pelanggan', function ($pelanggan) {
                     return $pelanggan->count() > 0;
                 })
                 ->assertViewHas('antrian', function ($antrian) {
                     return $antrian->count() > 0;
                 })
                 ->assertViewHas('username', 'admin123');
    }
    public function test_cari_laporanServis()
    {
        // Buat data pelanggan dan antrian yang sesuai
        $pelanggan = Pelanggan::factory()->create(['nama_pelanggan' => 'John Doe']);
        $antrian = Antrian::factory()->create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tgl_servis' => now()->toDateString(),
            'no_antrian' => 1,
        ]);

        // Akses halaman pencarian laporan servis
        $response = $this->post('/cariLaporan', ['cari_laporan' => '1']);

        // Memastikan respons sukses (status 200)
        $response->assertStatus(200)
             ->assertViewIs('dashboard.datalaporanservis.viewlaporanservis')
            //  ->assertViewHas('antrian', function ($antrian) use ($pelanggan) {
            //      return $antrian->contains('id_pelanggan', $pelanggan->id_pelanggan);
            //  })
             ->assertViewHas('pelanggan')
             ->assertViewHas('username', 'admin123');
    }

    /**
     * Test Case Implementasi export data ke pdf sama excel
     */
    public function test_export_data_pdf()
    {
        $response = $this->get('/exportpdf');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_export_data_excel()
    {
        $response = $this->get('/exportexcel');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

}
