@component('mail::message')

Dear {{ $user->name }},<br>

Thank you for registering with us.<br> 
Your One Time Password is {{ $user->otp }}.<br>
Do not share this with anyone.<br>

Regards,<br>
Team Serendipity

@endcomponent
