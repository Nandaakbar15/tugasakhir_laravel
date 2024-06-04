@component('mail::message')
# Status Update

Dear {{ $antrian->user->name }},

The status of your service request (Antrian No: {{ $antrian->no_antrian }}) has been updated to: {{ $antrian->status_servis }}

Thank you for using our service.

@component('mail::button', ['url' => route('service.status', $antrian->id)])
View Service Status
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
