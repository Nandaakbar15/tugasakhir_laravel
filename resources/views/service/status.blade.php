@extends("dashboard.layouts.main")

@section('container')
    <div class="container">
        <h1>Service Status</h1>
        <p><strong>Customer Name:</strong> {{ $antrian->user->name }}</p>
        <p><strong>Queue Number:</strong> {{ $antrian->no_antrian }}</p>
        <p><strong>Service Date:</strong> {{ $antrian->tgl_servis }}</p>
        <p><strong>Service Status:</strong> {{ $antrian->status_servis }}</p>
    </div>
@endsection
