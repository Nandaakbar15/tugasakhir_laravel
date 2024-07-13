@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Ubah Status Servis</h1>
        <form action="/ubahstatus_servis/{{ $antrian->id_antrian }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_antrian" class="form-label">ID Antrian</label>
                <input type="text" class="form-control @error('id_antrian') is-invalid @enderror" id="id_antrian" name="id_antrian" value="{{ old('id_antrian', $antrian->id_antrian) }}" disabled>
                @error('id_antrian')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="id_konsol">ID Konsol</label>
                <input type="text" class="form-control @error('id_konsol') is-invalid @enderror" id="id_konsol" name="id_konsol" value="{{ old('id_konsol', $antrian->id_konsol) }}" disabled>
                @error('id_konsol')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email Pelanggan</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $antrian->email) }}" disabled>
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label for="tgl_service" class="form-label">Tanggal Service</label>
                <input type="date" class="form-control @error('tgl_service') is-invalid @enderror" id="tgl_rilis" name="tgl_rilis" value="{{ old('tgl_servis', $antrian->tgl_servis) }}" disabled>
                @error('tgl_rilis')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="status_servis">Status Servis</label>
                <select name="status_servis" id="status_servis" class="form-control @error('status_servis') is-invalid @enderror">
                    <option value="belum selesai" {{ $antrian->status_servis == 'belum selesai' ? 'selected' : '' }}>Belum selesai</option>
                    <option value="sudah selesai" {{ $antrian->status_servis == 'sudah selesai' ? 'selected' : '' }}>Sudah selesai</option>
                </select>
                @error('status_servis')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">Ubah!</button>
        </form>
        <a href="/status_servis" class="btn btn-primary">Kembali</a>
    </div>
@endsection
