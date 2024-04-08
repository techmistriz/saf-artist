<?php

namespace App\Models;

use App\Models\Common\MasterModel;

class BookingNumber extends MasterModel
{

    protected $fillable         = ['*'];
    private static $prefix      = "SAF";
    private static $codeLength  = 6;

    public static function __getBookingNumber()
    {
        $finalCode  = '';
        $counter    = 1;
        $gcidSku  = BookingNumber::orderByDesc('code')->first();

        if(!empty($gcidSku)) {
            $counter = $gcidSku->code;
            $counter += 1;
        }

        $finalCode = str_pad($counter, self::$codeLength, "0", STR_PAD_LEFT);
        $finalCode = self::$prefix.$finalCode;

        if($gcidSku){

            $gcidSku->code = $counter;
            $gcidSku->save();
            // BookingNumber::insert(['code' => $counter]);
            
        } else {
            BookingNumber::insert(['code' => $counter]);
        }

        return $finalCode;
    }

}