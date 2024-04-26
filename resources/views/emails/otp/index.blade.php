@component('mail::message')

Dear {{$data['name'] ?? ''}},

	This is your OTP: {{ $data['otp'] ?? '' }}.

Thank you,<br>
SAF Artist<br>
@endcomponent
