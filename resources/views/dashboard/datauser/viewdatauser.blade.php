@extends('dashboard.layouts.main')

@section('container')
<form action="/cariUser" method="POST" class="mb-4">
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari user..." aria-label="Cari user" name="cari_user" value="{{ request('cari_user') }}">
        <button class="btn btn-outline-secondary" type="submit">Cari user!</button>
    </div>
</form>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h3 class="text-primary">Data Pelanggan</h3>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Ubah Data</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $item)
                    <tr>
                        <td>{{ $item->id_pelanggan }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="/ubahdata_pelanggan/{{ $item->id_pelanggan }}" class="btn btn-primary"><img src="{{ asset('images/edit.png') }}" width="60px" height="60px"></a>
                        </td>
                        <td>
                            <form action="/hapusPelanggan/{{ $item->id_pelanggan }}" class="d-inline" method="POST">
                                @method('delete')
                                @csrf
                                <button class="badge border-0" onclick="return confirm('Yakin mau hapus data ini?')"><img src="{{ asset('images/delete.png') }}" alt="" width="60px" height="60px"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <h3 class="text-primary">Data Teknisi</h3>
            <a href="/tambahTeknisi" class="btn btn-primary">Tambah Data teknisi</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Teknisi</th>
                        <th>Nama Teknisi</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Ubah Data</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teknisi as $item)
                    <tr>
                        <td>{{ $item->id_teknisi }}</td>
                        <td>{{ $item->nama_teknisi }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>
                            <a href="/ubah_teknisi/{{ $item->id_teknisi }}" class="btn btn-primary"><img src="{{ asset('images/edit.png') }}" width="60px" height="60px"></a>
                        </td>
                        <td>
                            <form action="/hapusTeknisi/{{ $item->id_teknisi }}" class="d-inline" method="POST">
                                @method('delete')
                                @csrf
                                <button class="badge border-0" onclick="return confirm('Yakin mau hapus data ini?')"><img src="{{ asset('images/delete.png') }}" alt="" width="60px" height="60px"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="/dashboard" class="btn btn-primary">Kembali</a>
@endsection
