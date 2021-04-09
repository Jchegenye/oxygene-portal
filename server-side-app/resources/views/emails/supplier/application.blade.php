@component('mail::message')
Hello
<!-- @empty(!$data['step1']['full_name_organization'])
    {{ucfirst($data['step1']['full_name_organization'])}},
@endempty -->

<p>Your submission is well received.</p>

<p>Please find attached copy of your application No. <b>{{$data->supplier_number}}</b> from {{config('app.name')}}.</p>

Thank you,<br>
{{ config('app.name') }}
@endcomponent
