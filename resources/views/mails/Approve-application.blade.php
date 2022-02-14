@component('mail::message')
        {{ $maildata['title'] }}

        {{$maildata['message']}}

@component('mail::button', ['url' => $maildata['url']])
            Login
@endcomponent


        Thanks,
        {{ config('app.name') }}
@endcomponent
