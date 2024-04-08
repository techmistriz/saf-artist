@component('mail::message')

Dear {{$user->name}},
@component('mail::table')
	<table>
		<tr><td>We have updated your portal and request you to go through the changes.<br> In case of any discrepancies, please get in touch with your point of contact from the Serendipity Arts Team.</td></tr>
		<tr><td>Please note that if we do not hear from you within the next 48 hours we <br>will consider it as a confirmation from your end.</td></tr>
	</table>
@endcomponent

Regards,<br>
Team Serendipity Arts

@endcomponent
