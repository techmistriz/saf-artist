<?php

namespace App\Notifications;

class WhatsappNotification {

    private static $TOKEN 		= "85dd80948173cd735b5ad6bc7122fb7a9087952c";
    private static $URL 		= "https://pickyassist.com/app/api/v2/";
    private static $APPLICATION	= "8";
    private static $TEMPLATE1 	= "VV4330515"; // artist_form_login
    private static $TEMPLATE2 	= "AV4343104"; // artist_form_admin_changes

    public static function sendRegistrationMessage($user) {
    	
    	$mobile 					= $user->contact;
    	// $mobile 					= '9670038997';

        $payload 					= [];
        $payload['token'] 			= self::$TOKEN;
        $payload['application']		= self::$APPLICATION;
        $payload['template_id']		= self::$TEMPLATE1;
        $payload['data']			= [
	        [
	            "number" => $mobile,
	            "template_message" => [
	                $user->name,
	                $user->email,
	                \Helper::decrypt($user->password_plane)
	            ],
	            "language" => "en"
	        ]
        ];

        // dd($payload);

        $URL 				= self::$URL . 'push';
        $curl 				= curl_init();
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $URL,
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 30,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "POST",
		  	CURLOPT_POSTFIELDS => json_encode($payload),
		  	CURLOPT_HTTPHEADER => array(
		    	"content-type: application/json"
		  	),
		));

		$response 	= curl_exec($curl);
		$err 		= curl_error($curl);

		curl_close($curl);
		// dd($response);

		if ($err) {
		  	return "cURL Error #:" . $err;

		} else {
		  	return $response;
		}
    }

    public static function sendUpdateAccountDetailsMessage($user) {
    	
    	$mobile 					= $user->contact;
    	// $mobile 					= '9670038997';

        $payload 					= [];
        $payload['token'] 			= self::$TOKEN;
        $payload['application']		= self::$APPLICATION;
        $payload['template_id']		= self::$TEMPLATE2;
        $payload['data']			= [
	        [
	            "number" => $mobile,
	            "template_message" => [
	                $user->name,
	            ],
	            "language" => "en"
	        ]
        ];

        // dd($payload);

        $URL 				= self::$URL . 'push';
        $curl 				= curl_init();
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $URL,
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 30,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "POST",
		  	CURLOPT_POSTFIELDS => json_encode($payload),
		  	CURLOPT_HTTPHEADER => array(
		    	"content-type: application/json"
		  	),
		));

		$response 	= curl_exec($curl);
		$err 		= curl_error($curl);

		curl_close($curl);
		// dd($response);

		if ($err) {
		  	return "cURL Error #:" . $err;

		} else {
		  	return $response;
		}
    }
    
}