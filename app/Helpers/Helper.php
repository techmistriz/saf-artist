<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;

class Helper
{
    
    public static function curlRequest($url, $method, $fields = [])
    {
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if($method == 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            // Set here requred headers
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            "content-type: application/json",
        ]);

        
        // Execute post
        $result = curl_exec($ch);
        // dd($result);
        if ($result === FALSE) {
            // die('Curl failed: ' . curl_error($ch));
            $result = curl_error($ch);
        }

        // Close connection
        curl_close($ch);
        return $result;
    }

    public static function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public  function     isActivate($route){

        $routeName  =   \Route::currentRouteName();        
        if(in_array($routeName, $route)){
            return 'menu-item-active menu-item-open';
        }
    }

    static function createRecursiveFolders($folder, $base_path){

        $folderArr = explode(DIRECTORY_SEPARATOR, $folder);
        $folderTmp = $base_path.DIRECTORY_SEPARATOR;
        foreach ($folderArr as $key => $value) {

            $folderTmp .= $value.DIRECTORY_SEPARATOR;

            if (!(\File::isDirectory($folderTmp))) {
                \File::makeDirectory($folderTmp);
            }
        }
    }

    public static function getBookingNumber(){

        return \App\Models\BookingNumber::__getBookingNumber();
    }

    public static function deleteFile($folder, $fileName)
    {
        
        if (unlink($folder . $fileName)) {
            return true;
        } else {
            echo "No file deleted";
        }
    }

    public static function saveImage($request, $file_name, $folder)
    {
        $image = $request->file($file_name);
        $input['file_name'] = uniqid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($folder);
        $image->move($destinationPath, $input['file_name']);
        return $input['file_name'];
    }

    public static function saveBase64($baseString, $folder)
    {
        if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $baseString)) {
            return null;
        }
        
        $imageContents = base64_decode($baseString);

        // If its not base64 end processing and return false
        if ($imageContents === false) {
            return null;
        }

        $img = $baseString;
        $img = str_replace('data:image/jpg;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);

        if(strlen($img) < 25)
        {
            return null;
        }
        
        $data    = base64_decode($img);
        $Iname   = uniqid() . ".jpg";
        $file    = $folder . $Iname;
        $success = file_put_contents($file, $data);
        return $Iname;
    }

    public static function generateOtp($length = 6) {

        return rand(100000, 999999);
    }

    public static function getOrderNumber() {

        return \App\Models\OrderNumber::getOrderNumber();
    }

    public static function getInvoiceNumber() {

        return \App\Models\InvoiceNumber::getInvoiceNumber();
    }

    public static function generateRandomString($length = 10) {
    
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )), 1, $length);
    }

    public static function isSuperAdmin($moduleName, $rolePermissionArr = []) {
    	
    	if(empty($rolePermissionArr)) {
    		
    		$rolePermissionArr = session('rolePermission');
    	}

        if(@$rolePermissionArr['roleCode'] == 'SUPER_ADMIN') {
        	
        	return true;
        }

        return false;
    }

    public static function checkPermisson($moduleName, $rolePermissionArr = []) {
    	
    	if(empty($rolePermissionArr)){
    		
    		$rolePermissionArr = session('rolePermission');
    	}

        if(
        	@$rolePermissionArr['roleCode'] == 'SUPER_ADMIN' ||
        	@array_key_exists($moduleName, @$rolePermissionArr['permissions'])
    	){
        	return true;
        }

        return false;
    }

    public static function encrypt($string): string
   	{
   		if(empty($string)) return '';
        try {
        	return Crypt::encryptString($string);
        } catch (EncryptException $e) {
        	return '';
        }
   	}

   	public static function decrypt($string): string
    {
    	if(empty($string)) return 'N/A';
        try {
        	return Crypt::decryptString($string);
        } catch (DecryptException $e) {
        	return 'N/A';
        }
    }

}