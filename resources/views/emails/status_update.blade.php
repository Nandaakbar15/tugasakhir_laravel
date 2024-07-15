@component('mail::message')
<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td style="background-color: #007bff; padding: 10px; color: white; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">Status Update</h1>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px;">
            <p style="margin: 0; font-size: 18px;">
                Dear customer yang bernama <strong>{{ $antrian->nama_pelanggan }}</strong>,
            </p>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px;">
            <p style="margin: 0; font-size: 16px;">
                Status servis konsol kamu dengan no. antrian (Antrian No: <strong>{{ $antrian->no_antrian }}</strong>) sudah di ubah menjadi: <strong>{{ $antrian->status_servis }}</strong>
            </p>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px;">
            <p style="margin: 0; font-size: 16px;">
                Terimakasih sudah menggunakan layanan kami. Untuk selanjutnya dimohon datang ke toko,
                ambil konsol anda dan melakukan pembayaran.
            </p>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f8f9fa; padding: 10px; text-align: center;">
            <p style="margin: 0; font-size: 14px;">
                Thanks,<br>
                {{ config('app.name') }}
            </p>
        </td>
    </tr>
</table>
{{-- @endcomponent --}}
