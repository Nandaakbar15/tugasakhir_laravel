<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css") }}">
    <title>Playstation Games</title>
    <script type="text/javascript"src="{{ asset("https://app.sandbox.midtrans.com/snap/snap.js") }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/pelanggan/dashboardpelanggan">Playstation Games</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" href="/pelanggan/dashboardpelanggan">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/profilToko">Profil Toko</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/statusservis">Status Servis</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/pembayaran">Bayar</a></li>
                    </ul>
                    <a href="/logout" class="d-flex">Logout</a>
                </div>
            </div>
        </nav>
        <h1>Playstation Games</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Detail Pembayaran</h5>
                <table>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td> : {{ $pembayaran->nama }}</td>
                    </tr>
                    <tr>
                        <td>Email Pelanggan</td>
                        <td> : {{ $pembayaran->email }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon Pelanggan</td>
                        <td> : {{ $pembayaran->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>No. Antrian</td>
                        <td> : {{ $antrian->id_antrian }}</td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td> : {{ $jumlah_pembayaran }}</td>
                    </tr>
                </table>
                <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
            </div>
        </div>
    </div>

    <script src="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js") }}"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
        // Also, use the embedId that you defined in the div above, here.
        window.snap.pay('{{ $payment_token }}', {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    alert("pembayaran berhasil!!!!");
                    console.log(result);
                    document.location.href = "/pelanggan/dashboardpelanggan";
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("pembayaran gagal!");
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
</body>
</html>
