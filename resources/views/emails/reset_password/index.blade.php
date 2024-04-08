@component('mail::message')

Dear {{$user->name}},

	A request has been received to change the password for your Serendipity portal.

@component('mail::button', ['url' => $user->reset_url])
    Reset Password
@endcomponent


	This password reset link will expire in 60 minutes.
	If you did not request a password reset, no further action is required.

Thank you,
Team Serendipity Arts
@endcomponent
