@component('mail::message')

Dear {{$user->name}},

	We are pleased to confirm your registration with us. <br>
	Requesting you to take some time to fill the form using the login credentials are as below.

@component('mail::table')
<table>
	<tr><td>User Name: </td><td>{{$user->email ?? ''}} </td></tr>
	<tr><td>Password: </td><td>{{ \Helper::decrypt($user->password_plane ?? '') }} </td></tr>
</table>
@endcomponent

You can also click on this link to access the form.<br>
<a href="http://artist.serendipityarts.org/login">http://artist.serendipityarts.org/login</a><br>


We are happy to have you on board,<br>
Team Serendipity Arts
@endcomponent
