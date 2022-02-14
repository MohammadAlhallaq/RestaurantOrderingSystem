@component('mail::message')
    {{ $maildata['title'] }}

    {{$maildata['message']}}

@component('mail::button', ['url' => $maildata['url']])
        Reset Password
@endcomponent


    Thanks,
    {{ config('app.name') }}
@endcomponent
