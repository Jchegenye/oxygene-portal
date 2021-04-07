@component('mail::message')
Hello Admin,

<p>A new application No. <b>{{$data->supplier_number}}</b> has been submitted by <b>{{$data['step1']['full_name_organization']}}</b>.</p>

<p>Please find attached copy of this application and other attachments.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
