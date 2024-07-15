@extends('dashboard.layouts.main')

@section('container')
<form action="/cariLaporan" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari laporan..." aria-label="Cari game" name="cari_laporan" value="{{ request('cari_laporan') }}">
        <button class="btn btn-outline-secondary" type="button">Cari laporan!</button>
    </div>
</form>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3 mb-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan</h6>
    </div>

    <div class="col-auto inline mb-4">
        <a href="/exportexcel" class="btn btn-success">Export Excel</a>
        <a href="/exportpdf" class="btn btn-info">Export PDF</a>
    </div>

    {{-- <div class="col-auto inline mb-4">

    </div> --}}
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Konsol</th>
                        <th>Kendala/Kerusakan</th>
                        <th>Tanggal Servis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $item)
                    <tr>
                        <td>{{ $item->id_pelanggan }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>
                            @foreach ($item->konsol as $konsol)
                                {{ $konsol->nama_konsol }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->konsol as $konsol)
                                @foreach ($konsol->kendala as $kendala)
                                    {{ $kendala->kendala_kerusakan }}
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            @foreach ($antrian as $a)
                                {{ $a->tgl_servis }}
                            @endforeach
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
