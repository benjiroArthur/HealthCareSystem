@component('mail::message')
<p>Hi! I'm {{$full_name}}.</p>

<p>{{$bodymessage}}.</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
