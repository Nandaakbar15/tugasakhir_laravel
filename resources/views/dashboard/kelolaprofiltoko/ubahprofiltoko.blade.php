@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Ubah Profil Toko</h1>
        <input type="hidden" name="gambarLama" value="{{ $profiltoko_request->foto }}">
        <form action="/ubahprofilToko/{{ $profiltoko_request->id_toko }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" class="form-control @error('nama_toko') is-invalid @enderror" id="nama_toko" name="nama_toko" autofocus value="{{ old('nama_toko', $profiltoko_request->nama_toko) }}">
            @error('nama_toko')
                <div class="is-invalid">
                    {{ $message }}
             </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Toko</label>
            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" autofocus value="{{ old('deskripsi', $profiltoko_request->deskripsi) }}">
            @error('deskripsi')
                <div class="is-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            @if ($profiltoko_request->foto)
                <img src="{{ asset($profiltoko_request->foto) }}" alt="" width="300px" height="200px">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <div class="img-preview">
                <label class="form-label" for="foto">foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" onchange="previewImage()">

                @error('foto')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">ubah!</button>
        </form>
    </div>
    <script text="text/javascript">
        function previewImage() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
