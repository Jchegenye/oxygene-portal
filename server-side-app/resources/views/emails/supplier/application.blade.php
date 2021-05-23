@component('mail::message')

@php 
    $objStep1 = json_decode($data['step1']); 
    $step1 = $objStep1->basicinfo;
@endphp

Hello
@empty(!$step1->full_name_organization)
    {{ucfirst($step1->full_name_organization)}},
@endempty

<p>Your submission is well received.</p>

<p>Please find the attached copy of your application No. <b>{{$data->supplier_number}}</b> from {{config('app.name')}}.</p>

<p>Kindly sign it and send a copy to <a href="mailto:@php echo env('MAIL_FINANCE_ADDRESS') @endphp">{{env('MAIL_FINANCE_ADDRESS')}}</a> and CC <a href="mailto:@php echo env('MAIL_PROCUREMENT_ADDRESS') @endphp">{{env('MAIL_PROCUREMENT_ADDRESS')}}</a></p>

Thank you,<br>
{{ config('app.name') }}
@endcomponent
