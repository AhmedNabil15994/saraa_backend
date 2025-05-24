@component('mail::message')

<h2>
    <center> {{ __('Auth::login.reset.mail.header') }} </center>
</h2>

@component('mail::button', [
'url' => url(route('auth.password.reset',$token['token']). '?email=' . $token['user']->email)
])

{{ __('Auth::login.reset.mail.button_content') }}

@endcomponent

@endcomponent
