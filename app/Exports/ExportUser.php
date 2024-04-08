<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ExportUser implements FromCollection, WithHeadings {

	public $category_ids;

	public function __construct($__category_ids)
    {
        $this->category_ids = $__category_ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
    	$userRoleCode = \Auth::user()->getUserRoleCode();

    	User::$withoutAppends = true;
        $User = User::select(
        	'salutation',
        	'name',
        	'email',
        	'gender',
        	'country_code',
        	'contact',
        	'dob',
        	'permanent_address',
        	'pa_city_id',
        	'pa_state_id',
        	'pa_country_id',
        	'pa_pincode',
        	'current_address',
        	'ca_city_id',
        	'ca_state_id',
        	'ca_country_id',
        	'ca_pincode',
        	'address_proof_type',
        	'address_proof_image',
        	'stage_name',
        	'artist_bio',
        	'facebook_username',
        	'facebook_url',
        	'instagram_urername',
        	'instagram_url',
        	'linkdin_username',
        	'linkdin_url',
        	'twitter_username',
        	'twitter_url',
        	'website',
        	'practice_image_1',
        	'practice_image_2',
        	'practice_image_3',
        	'profile_image_1',
        	'profile_image_2',
        	'has_serendipity_arts',
        	'year',
        	'other_link',
        	'created_at',
        );

        if($userRoleCode !== 'SUPER_ADMIN'){
        	
        	$User->whereIn('category_id', $this->category_ids);
        }

        return $User->get();
    }

    public function headings(): array
    {
        $arr =  [
          	'salutation',
        	'name',
        	'email',
        	'gender',
        	'country_code',
        	'contact',
        	'dob',
        	'permanent_address',
        	'pa_city_id',
        	'pa_state_id',
        	'pa_country_id',
        	'pa_pincode',
        	'current_address',
        	'ca_city_id',
        	'ca_state_id',
        	'ca_country_id',
        	'ca_pincode',
        	'address_proof_type',
        	'address_proof_image',
        	'stage_name',
        	'artist_bio',
        	'facebook_username',
        	'facebook_url',
        	'instagram_urername',
        	'instagram_url',
        	'linkdin_username',
        	'linkdin_url',
        	'twitter_username',
        	'twitter_url',
        	'website',
        	'practice_image_1',
        	'practice_image_2',
        	'practice_image_3',
        	'profile_image_1',
        	'profile_image_2',
        	'has_serendipity_arts',
        	'year',
        	'other_link',
        	'created_at'
        ];

        foreach ($arr as $key => $value) {
        	$arr[$key] = ucwords(str_replace("_", " ", $value));
        }

        return $arr;
    }

    

}
