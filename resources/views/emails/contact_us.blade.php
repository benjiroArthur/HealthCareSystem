@component('mail::message')
<p>Hi! I'm {{$data['full_name']}}.</p>

<p>{{$data['bodymessage']}}.</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
