<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Data Laporan Servis</h1>

<table id="customers">
  <tr>
    <th>ID Pelanggan</th>
    <th>Nama Pelanggan</th>
    <th>Nama Konsol</th>
    <th>Kendala dan Kerusakan</th>
    <th>Tanggal Servis</th>
  </tr>
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
</table>

</body>
</html>
