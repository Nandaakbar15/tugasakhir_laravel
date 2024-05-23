<!DOCTYPE html>
<html>
<head>
    <title>New Service Request</title>
</head>
<body>
    <h1>New Service Request</h1>
    <p><strong>Nama Pelanggan:</strong> {{ $notificationContent['nama_pelanggan'] }}</p>
    <p><strong>Alamat:</strong> {{ $notificationContent['alamat'] }}</p>
    <p><strong>Email:</strong> {{ $notificationContent['email'] }}</p>
    <p><strong>No. Telp:</strong> {{ $notificationContent['no_telp'] }}</p>
    <p><strong>Nama Konsol:</strong> {{ $notificationContent['nama_konsol'] }}</p>
    <p><strong>Kendala dan Kerusakan:</strong> {{ $notificationContent['kendala_kerusakan'] }}</p>
</body>
</html>
