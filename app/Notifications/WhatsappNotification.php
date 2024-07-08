<?php

namespace App\Notifications;

class WhatsappNotification {

    private static $TOKEN 		= "85dd80948173cd735b5ad6bc7122fb7a9087952c";
    private static $URL 		= "https://pickyassist.com/app/api/v2/";
    private static $APPLICATION	= "8";

    private static $TEMPLATE1 	= "JJ8587723"; // Registration OTP
    private static $TEMPLATE2 	= "BW5043155"; // Registration OTP
    private static $TEMPLATE3 	= "YJ5163103"; // Registration OTP

    public static function sendRegistrationOTP($mobile, $otp) {
    	
    	// return true;
        $payload 					= [];
        $payload['token'] 			= self::$TOKEN;
        $payload['application']		= self::$APPLICATION;
        $payload['template_id']		= self::$TEMPLATE1;
        $payload['data']			= [
	        [
	            "number" => $mobile,
	            "template_message" => [
	                "User",
	                $otp
	            ],
	            "language" => "en_GB"
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
		  	CURLOPT_SSL_VERIFYHOST => 0,
		  	CURLOPT_SSL_VERIFYPEER => 0,
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
		return true;

		if ($err) {
		  	// return "cURL Error #:" . $err;
		  	return false;

		} else {
		  	return $response;
		}
    }

    public static function sendOrderMessage($data) {
    	

    	return false;
        $payload 					= [];
        $payload['token'] 			= self::$TOKEN;
        $payload['application']		= self::$APPLICATION;
        $payload['template_id']		= self::$TEMPLATE2;
        $payload['data']			= [
	        [
	            "number" => $mobile,
	            "template_message" => [
	                $otp
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
		  	CURLOPT_SSL_VERIFYHOST => 0,
		  	CURLOPT_SSL_VERIFYPEER => 0,
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

		return true;

		if ($err) {
		  	// return "cURL Error #:" . $err;
		  	return false;

		} else {
		  	return $response;
		}
    }

    public static function sendRegistrationMessageVolunteer($mobile, $name) {
    	
    	// return true;
        $payload 					= [];
        $payload['token'] 			= self::$TOKEN;
        $payload['application']		= self::$APPLICATION;
        $payload['template_id']		= self::$TEMPLATE3;
        $payload['data']			= [
	        [
	            "number" => $mobile,
	            "template_message" => [
	                $name
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
		  	CURLOPT_SSL_VERIFYHOST => 0,
		  	CURLOPT_SSL_VERIFYPEER => 0,
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

		return true;
		
		if ($err) {
		  	// return "cURL Error #:" . $err;
		  	return false;

		} else {
		  	return $response;
		}
    }

}