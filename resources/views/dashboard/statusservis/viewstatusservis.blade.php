@extends('dashboard.layouts.main')

@section('container')
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Status Servis</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No. Antrian</th>
                                            <th>ID Konsol</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Email Pelanggan</th>
                                            <th>Foto Kondisi konsol</th>
                                            <th>Tanggal Servis</th>
                                            <th>Status Servis</th>
                                            <th>Ubah Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($antrian as $item)
                                        <tr>
                                            <td>{{ $item->no_antrian }}</td>
                                            <td>{{ $item->id_konsol }}</td>
                                            <td>{{ $item->nama_pelanggan }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td><img src="{{ asset($item->konsol->foto) }}" alt="" srcset="" width="200px" height="200px"></td>
                                            <td>{{ $item->tgl_servis }}</td>
                                            <td>{{ $item->status_servis }}</td>
                                            <td>
                                                <a href="/ubahstatus_servis/{{ $item->id_antrian }}" class="btn btn-primary"><img src="{{ asset('images/edit.png') }}" width="60px" height="60px"></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   <a href="/dashboard" class="btn btn-primary">Kembali</a>
                   <br>
                   <br>
                   <small>Kirim pesan ini kepada pelanggan yang melakukan servis</small>
                   <br>
                   <a href="/kirim-pesan" class="btn btn-primary">Kirim!</a>
@endsection
