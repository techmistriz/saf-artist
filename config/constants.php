<?php 

return [
	
	'years'	=>	array(
		"2016"	=>	'2016',
		"2017"	=>	'2017',
		"2018"	=>	'2018',
		"2019"	=>	'2019',
		"2022"	=>	'2022',
	),

	'category_form_mapper'	=>	array(
		"Accessibility"		=>	'accessibility',
		"Craft"				=>	'craft',
		"Culinary Arts"		=>	'culinary_arts',
		"Performing Arts"	=>	'performing_arts',
		"Dance"				=>	'dance',
		"Exhibitions"		=>	'exhibitions',
		"Music"				=>	'music',
		"Photography"		=>	'photography', // 
		"Talks"				=>	'talks', // 
		"Theatre"			=>	'theatre',
		"Visual Arts"		=>	'visual_arts',
		"Special Project"	=>	'special_project',
		"Workshops"			=>	'workshops', //
		"Vendors@SAF"		=>	'vendorssaf', //
		"Default"			=>	'default',
	),

	'role_form_mapper'	=>	array(
		"ARTIST"		=>	'artist',
		"TROUPE_GROUP"				=>	'troupe_group',
		
	),

	'numbers'	=>	range(1,50),

	'TICKET_STATUS' => [
		'Added by Group' => 0,
		'Added by Admin' => 1,
		'COMPLETED' => 2,
		'CANCELLED' => 3,
	],

	'HOTEL_STATUS' => [
		'Added by Group' => 0,
		'Added by Admin' => 1,
		'COMPLETED' => 2,
		'CANCELLED' => 3,

	]

];