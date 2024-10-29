@component('mail::message')
Hi, {{ $save->username }} . Please set new account password

<p>It happens, Click the link below..</p>

@component('mail::button', ['url' => url('set_new_password/' . $save->remember_token)])
Set Your Password
@endcomponent

Thank You
@endcomponent
