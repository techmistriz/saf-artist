@component('mail::message')

Dear {{$user->name}},

	Thank you for registration with us, please find the login credentials below.

@component('mail::table')
<table>
	<tr><td>User Name: </td><td>{{$user->name ?? ''}} </td></tr>
	<tr><td>Email: </td><td>{{$user->email ?? ''}} </td></tr>
	<tr><td>Password: </td><td>{{ $user->password_plane ?? '' }} </td></tr>
</table>
@endcomponent

Regards,<br>
Team Serendipity Arts
@endcomponent
