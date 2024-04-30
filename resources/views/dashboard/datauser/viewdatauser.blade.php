@extends('dashboard.layouts.main')

@section('container')
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
