@component('mail::message')
Hello
@empty(!$data['step1']['full_name_organization'])
    {{ucfirst($data['step1']['full_name_organization'])}},
@endempty

<p>Your submission is well received.</p>

<p>Please find the attached copy of your application No. <b>{{$data->supplier_number}}</b> from {{config('app.name')}}.</p>

<p>Kindly sign it and send a copy to <a href="mailto:finance@oxygene.co.ke">finance@oxygene.co.ke</a> and CC <a href="mailto:corazon.wasike@oxygene.co.ke">corazon.wasike@oxygene.co.ke</a></p>

Thank you,<br>
{{ config('app.name') }}
@endcomponent
