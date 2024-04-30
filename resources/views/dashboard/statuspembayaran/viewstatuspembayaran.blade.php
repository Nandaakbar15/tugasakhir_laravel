@extends('dashboard.layouts.main')

@section('container')
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Status Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Pembayaran</th>
                                            <th>ID Pelanggan</th>
                                            <th>ID Antrian</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayaran as $data)
                                        <tr>
                                            <td>{{ $data->id_pembayaran }}</td>
                                            <td>{{ $data->id_pelanggan }}</td>
                                            <td>{{ $data->id_antrian }}</td>
                                            <td>{{ $data->jumlah_pembayaran }}</td>
                                            <td>{{ $data->tgl_pembayaran }}</td>
                                            <td>{{ $data->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="/dashboard" class="btn btn-primary">Kembali</a>
@endsection
