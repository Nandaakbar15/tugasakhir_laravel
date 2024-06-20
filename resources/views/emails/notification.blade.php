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
    <p><strong>Foto Kondisi Konsol</strong>
    <br>
    <img src="{{ $message->embed($notificationContent['foto']) }}" width="100px" height="80px" alt="Kondisi Konsol">
    <br>
     @if (!empty($notificationContent['game_list']))
        <h2>Game yang di request:</h2>
        <ul>
            @foreach ($notificationContent['game_list'] as $game)
                <li>
                    <p><strong>Nama Game:</strong> {{ $game['nama_game'] }}</p>
                    <p><strong>Developer:</strong> {{ $game['developer'] }}</p>
                    <p><strong>Tanggal Rilis:</strong> {{ $game['tgl_rilis'] }}</p>
                    <p><strong>Platform:</strong> {{ $game['platform'] }}</p>
                    <img src="{{ $message->embed($game['foto']) }}" width="100px" height="80px" alt="{{ $game['nama_game'] }}">
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
