<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use DB;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;
use FileUploadHelper;

trait UserTrait
{
	/**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateProfile(Request $request, $user_id = NULL) {

    	if(empty($user_id)){

    		$user_id 						= \Auth::user()->id;
    		$user 							= User::findOrFail($user_id);
    		
    	} else {
    		
    		$user 							= User::findOrFail($user_id);

    		if(empty($user)){
    			$user = new User();
    		}
    	}
    	
    	$user->category_id 				= $request->category_id;
    	$user->salutation 				= $request->salutation;
    	$user->name 					= $request->name;
    	$user->email 					= $request->email;

    	if($request->has('password') && $request->filled('password')) {
	    	$user->password = Hash::make($request->password);
	    }

    	$user->gender 					= $request->gender;
    	$user->contact 					= $request->contact;
    	// $user->age						= $request->age;
    	$user->dob						= $request->dob;
    	$user->permanent_address		= $request->permanent_address;
    	$user->pa_city_id				= $request->pa_city_id;
    	$user->pa_state_id				= $request->pa_state_id;
    	$user->pa_country_id			= $request->pa_country_id;
    	$user->pa_pincode				= $request->pa_pincode;
    	$user->same_as_permanent_address	= $request->same_as_permanent_address;
    	
    	if($request->has('same_as_permanent_address') && $request->filled('same_as_permanent_address') && $request->same_as_permanent_address == '1'){

    		$user->current_address			= $request->permanent_address;
	    	$user->ca_country_id			= $request->pa_country_id;
	    	$user->ca_state_id				= $request->pa_state_id;
	    	$user->ca_city_id				= $request->pa_city_id;
	    	$user->ca_pincode				= $request->pa_pincode;

    	} else {
    		$user->current_address			= $request->current_address;
	    	$user->ca_country_id			= $request->ca_country_id;
	    	$user->ca_state_id				= $request->ca_state_id;
	    	$user->ca_city_id				= $request->ca_city_id;
	    	$user->ca_pincode				= $request->ca_pincode;
    	}
    	
    	// $user->address_proof_type		= $request->address_proof_type;

    	if ($request->hasFile('address_proof_image')) {

            $address_proof_image       		= $request->file('address_proof_image');
            $address_proof_image_fileName	= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $address_proof_image, $request->input('title'), 900, 900, true);
            $user->address_proof_image 		= $address_proof_image_fileName;
        }

    	$user->stage_name					= $request->stage_name;
    	$user->artist_bio					= $request->artist_bio;
    	$user->facebook_username			= $request->facebook_username;
    	$user->facebook_url					= $request->facebook_url;
    	$user->instagram_urername			= $request->instagram_urername;
    	$user->instagram_url				= $request->instagram_url;
    	$user->linkdin_username				= $request->linkdin_username;
    	$user->linkdin_url					= $request->linkdin_url;
    	$user->twitter_username				= $request->twitter_username;
    	$user->twitter_url					= $request->twitter_url;
    	$user->website						= $request->website;
    	
    	if ($request->hasFile('practice_image_1')) {

            $practice_image_1       		= $request->file('practice_image_1');
            $practice_image_1_fileName		= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_1, $request->input('title'), 900, 900, true);
            $user->practice_image_1 		= $practice_image_1_fileName;
        }

        if ($request->hasFile('practice_image_2')) {

            $practice_image_2       		= $request->file('practice_image_2');
            $practice_image_2_fileName		= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_2, $request->input('title'), 900, 900, true);
            $user->practice_image_2 		= $practice_image_2_fileName;
        }

        if ($request->hasFile('practice_image_3')) {

            $practice_image_3       	= $request->file('practice_image_3');
            $practice_image_3_fileName    			= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_3, $request->input('title'), 900, 900, true);

            $user->practice_image_3 	= $practice_image_3_fileName;
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1       	= $request->file('profile_image_1');
            $profile_image_1_fileName    			= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('title'), 900, 900, true);

            $user->profile_image_1 	= $profile_image_1_fileName;
        }

        if ($request->hasFile('profile_image_2')) {

            $profile_image_2       		= $request->file('profile_image_2');
            $profile_image_2_fileName	= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_2, $request->input('title'), 900, 900, true);
            $user->profile_image_2 	= $profile_image_2_fileName;
        }

        $user->has_serendipity_arts 	= $request->has_serendipity_arts;
        $user->year 					= $request->year;
        $user->other_link 				= $request->other_link;
    	$user->save();

    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateCategoryDetails(Request $request){

    	$this->__updateCategoryDetailsOthers();

    	$userCategoryDetail->save();
    }

    public function __updateCategoryDetailsAccessibility(Request $request, $user_id = NULL){

    	if(empty($user_id)){

    		$user_id	= \Auth::user()->id;
    	}

    	$userCategoryDetail										= UserCategoryDetail::where('user_id', $user_id)->first();
    	$userCategoryDetail->project_name 						= $request->project_name;
    	$userCategoryDetail->no_of_people_in_group				= $request->no_of_people_in_group;
    	$userCategoryDetail->form_genre 						= $request->form_genre;
    	$userCategoryDetail->organisation						= $request->organisation;
    	$userCategoryDetail->light_designer_needed 				= $request->light_designer_needed;
    	$userCategoryDetail->sound_designer_needed				= $request->sound_designer_needed;
    	$userCategoryDetail->iprs_license_required				= $request->iprs_license_required;
    	$userCategoryDetail->space_visual_design_requirements	= $request->space_visual_design_requirements;
    	$userCategoryDetail->biodata							= $request->biodata;
    	$userCategoryDetail->tech_rider							= $request->tech_rider;
    	$userCategoryDetail->save();
    }

    public function __updateCategoryDetailsCraft(Request $request, $user_id = NULL){

    	if(empty($user_id)){

    		$user_id	= \Auth::user()->id;
    	}

    	$userCategoryDetail 										= UserCategoryDetail::where('user_id', $user_id)->first();
    	$userCategoryDetail->project_name 							= $request->project_name;
    	$userCategoryDetail->organisation							= $request->organisation;
    	$userCategoryDetail->name_of_the_artisan 					= $request->name_of_the_artisan;
    	$userCategoryDetail->about_the_artisan						= $request->about_the_artisan;
    	$userCategoryDetail->name_of_the_design_studio 				= $request->name_of_the_design_studio;
    	$userCategoryDetail->about_the_design_studio				= $request->about_the_design_studio;
    	$userCategoryDetail->about_the_crafts						= $request->about_the_crafts;
    	$userCategoryDetail->about_the_director						= $request->about_the_director;
    	$userCategoryDetail->brand_name								= $request->brand_name;
    	
    	if ($request->hasFile('brand_logo')) {

            $brand_logo       					= $request->file('brand_logo');
            $brand_logo_fileName				= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $brand_logo, $request->input('title'), 900, 900, true);
            $userCategoryDetail->brand_logo		= $brand_logo_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_designer_1')) {

            $high_res_images_of_the_designer_1						= $request->file('high_res_images_of_the_designer_1');
            $high_res_images_of_the_designer_1_fileName				= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_designer_1, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_designer_1	= $high_res_images_of_the_designer_1_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_designer_2')) {

            $high_res_images_of_the_designer_2       					= $request->file('high_res_images_of_the_designer_2');
            $high_res_images_of_the_designer_2_fileName					= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_designer_2, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_designer_2 		= $high_res_images_of_the_designer_2_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_designer_3')) {

            $high_res_images_of_the_designer_3       					= $request->file('high_res_images_of_the_designer_3');
            $high_res_images_of_the_designer_3_fileName					= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_designer_3, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_designer_3 		= $high_res_images_of_the_designer_3_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_1')) {

            $high_res_images_of_the_product_1       					= $request->file('high_res_images_of_the_product_1');
            $high_res_images_of_the_product_1_fileName					= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_1, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_1 		= $high_res_images_of_the_product_1_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_2')) {

            $high_res_images_of_the_product_2       					= $request->file('high_res_images_of_the_product_2');
            $high_res_images_of_the_product_2_fileName					= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_2, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_2 		= $high_res_images_of_the_product_2_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_3')) {

            $high_res_images_of_the_product_3       					= $request->file('high_res_images_of_the_product_3');
            $high_res_images_of_the_product_3_fileName					= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_3, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_3 		= $brand_logo_fileName;
        }			
        
    	$userCategoryDetail->save();
    }

    public function __updateCategoryDetailsOthers(Request $request, $user_id = NULL){

    	if(empty($user_id)){

    		$user_id	= \Auth::user()->id;
    	}

    	$userCategoryDetail 									= UserCategoryDetail::where('user_id', $user_id)->first();
    	$userCategoryDetail->project_name 						= $request->project_name;
    	$userCategoryDetail->no_of_people_in_group				= $request->no_of_people_in_group;
    	$userCategoryDetail->form_genre 						= $request->form_genre;
    	$userCategoryDetail->organisation						= $request->organisation;
    	$userCategoryDetail->light_designer_needed 				= $request->light_designer_needed;
    	$userCategoryDetail->sound_designer_needed				= $request->sound_designer_needed;
    	$userCategoryDetail->iprs_license_required				= $request->iprs_license_required;
    	$userCategoryDetail->space_visual_design_requirements	= $request->space_visual_design_requirements;
    	$userCategoryDetail->biodata							= $request->biodata;
    	$userCategoryDetail->tech_rider							= $request->tech_rider;
    	$userCategoryDetail->save();
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateAccountDetails(Request $request, $user_id = NULL){

    	if(empty($user_id)){

    		$user_id	= \Auth::user()->id;
    	}

    	$userAccountDetail 							= UserAccountDetail::where('user_id', $user_id)->first();
    	$userAccountDetail->name 					= $request->name;
    	$userAccountDetail->permanent_address		= $request->permanent_address;

    	if ($request->hasFile('address_proof_image')) {

            $address_proof_image       			= $request->file('address_proof_image');
            $address_proof_image_fileName		= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $address_proof_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->address_proof_image 			= $address_proof_image_fileName;
        }

    	$userAccountDetail->account_number			= $request->account_number;
    	$userAccountDetail->bank_holder_number 		= $request->bank_holder_number;
    	$userAccountDetail->bank_name				= $request->bank_name;
    	$userAccountDetail->branch_address			= $request->branch_address;
    	$userAccountDetail->ifsc_code				= $request->ifsc_code;

    	if ($request->hasFile('cancel_cheque_image')) {

            $cancel_cheque_image       			= $request->file('cancel_cheque_image');
            $cancel_cheque_image_fileName		= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $cancel_cheque_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->cancel_cheque_image 			= $cancel_cheque_image_fileName;
        }

    	$userAccountDetail->pancard_number		= $request->pancard_number;

    	if ($request->hasFile('pancard_image')) {

            $pancard_image       				= $request->file('pancard_image');
            $pancard_image_fileName				= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $pancard_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->pancard_image 				= $pancard_image_fileName;
        }

    	$userAccountDetail->has_gst_number		= $request->has_gst_number;

    	if ($request->hasFile('gst_certificate_file')) {

            $gst_certificate_file       		= $request->file('gst_certificate_file');

            $gst_certificate_file_fileName		= FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $gst_certificate_file, 'gst_certificate_file');

            $userAccountDetail->gst_certificate_file 		= $gst_certificate_file_fileName;
        }

    	$userAccountDetail->hsn_sac_code		= $request->hsn_sac_code;

    	if ($request->hasFile('product_inventory_file')) {

            $product_inventory_file       		= $request->file('product_inventory_file');
            $product_inventory_file_fileName	= FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $product_inventory_file, 'product_inventory_file');
            $userAccountDetail->product_inventory_file 		= $product_inventory_file_fileName;
        }

    	$userAccountDetail->save();

    }

}