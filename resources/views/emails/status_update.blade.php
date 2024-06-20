@component('mail::message')
# Status Update

Dear {{ $antrian->user->name }},

Status servis konsol kamu dengan no. antrian (Antrian No: {{ $antrian->no_antrian }}) sudah di ubah menjadi: {{ $antrian->status_servis }}

Terimakasih sudah menggunakan layanan kami.

@component('mail::button', ['url' => route('service.status', $antrian->id)])
View Service Status
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
