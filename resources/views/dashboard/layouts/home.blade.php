@extends('dashboard.layouts.main')

@section('container')

    <style>
        .custom-card {
            align-content: center;
            background-color: chartreuse;
            font: bold;
            display: flex; /* Use flexbox layout */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            flex-direction: column; /* Align content in column */
            height: 10rem; /* Set card height */
        }
    </style>
   <!-- Begin Page Content -->
               <!-- Page Heading -->
               <div class="card custom-card" style="width: 35rem;">
                    <div class="card-body">
                        <h5 class="card-title">Selamat Datang Admin</h5>
                    </div>
            </div>

@endsection
