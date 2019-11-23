@component('mail::message')
# Introduction

The body of your message.
{{$password_random}}
@component('mail::button', ['url' => '$url'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
