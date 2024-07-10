<tr>
	<td class="header">
		<a href="{{ $url }}" style="display: inline-block;">

			@if (trim($slot) === 'Laravel')
				<img src="{{env('APP_URL')}}/image/logo-saf-2024-black.png" class="logo" alt="{{ env('APP_NAME', 'N/A') }}" style="height: 60px; width:auto;">
			@else
				<img src="http://artist24.demoserver.co.in/media/logos/logo-white.png" class="logo" alt="{{ env('APP_NAME', 'Laravel') }}" style="height: 60px; width:auto;">
			@endif
			
		</a>
	</td>
</tr>
