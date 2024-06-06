@extends('dashboardpelanggan.layouts.main')

@section('container')
<style>
    table {
        font: bold;
        background-color: white;
    }
</style>
<div class="container-fluid">
    <h1>Status Servis</h1>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>ID Antrian</th>
                        <th>ID Konsol</th>
                        <th>ID Pelanggan</th>
                        <th>Foto Kondisi Konsol</th>
                        <th>Tanggal Servis</th>
                        <th>Status Servis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrian as $data)
                    <tr>
                        <td>{{ $data->no_antrian }}</td>
                        <td>{{ $data->id_antrian }}</td>
                        <td>{{ $data->id_konsol }}</td>
                        <td>{{ $data->id_pelanggan }}</td>
                        <td><img src="{{ asset($data->konsol->foto) }}" width="100px" height="90px"></td>
                        <td>{{ $data->tgl_servis }}</td>
                        <td>{{ $data->status_servis }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="/pelanggan/dashboardpelanggan" class="btn btn-primary">Kembali</a>
</div>
@endsection
