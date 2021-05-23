@component('mail::message')

@php 
    $objStep1 = json_decode($data['step1']); 
    $step1 = $objStep1->basicinfo;
@endphp

Hello Admin,

<p>A new application No. <b>{{$data->supplier_number}}</b> has been submitted by <strong>{{$step1->full_name_organization}}</strong>.</p>

<p>Please find attached copies of this application and other attachments.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
