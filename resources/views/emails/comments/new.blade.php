@component('mail::message')
# New comment alerts

### You have a new comment you haven't checked.

### 来源
{{ $data->origin }}

### 内容
{{ $data->content }}

@component('mail::button', ['url' => 'https://admin.lnmpa.top/'])
    管理
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
