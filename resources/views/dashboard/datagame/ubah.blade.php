@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Ubah Game</h1>
        <input type="hidden" name="gambarLama" value="{{ $game_request->foto }}">
        <form action="/ubahgame/{{ $game_request->id_game }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_game" class="form-label">Nama Game</label>
                <input type="text" class="form-control @error('nama_game') is-invalid @enderror" id="nama_game" autofocus value="{{ old($game_request->nama_game,'nama_game') }}">

                @error('nama_game')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tgl_rilis" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control @error('tgl_rilis') is-invalid @enderror" id="tgl_rilis" autofocus value="{{ old($game_request->tgl_rilis, 'tgl_rilis') }}">

                @error('tgl_rilis')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="platform">Platform</label>
                <input type="text" class="form-control @error('platform') is-invalid @enderror" id="platform" required value="{{ old($game_request->platform, 'platform') }}">

                @error('platform')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="developer">Developer</label>
                <input type="text" class="form-control @error('developer') is-invalid @enderror" id="developer" required value="{{ old($game_request->developer, 'developer') }}">

                @error('developer')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                @if ($game_request->foto)
                    <img src="{{ asset($game_request->foto) }}" alt="" width="300px" height="200px">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <div class="img-preview">
                    <label class="form-label" for="foto">foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" onchange="previewImage()">

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
    <a href="/dashboard" class="btn btn-primary">Kembali</a>
@endsection
