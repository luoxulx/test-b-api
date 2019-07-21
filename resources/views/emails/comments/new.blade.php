@component('mail::message')
# Introduction

The body of your message.

## content
$data['content']

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
