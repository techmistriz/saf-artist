<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\User;
use App\Models\UserProfile;
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
     * Store a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __storeUserProfile(Request $request) {

        

        $user_profile = new UserProfile();

        $user_profile->profile_status           = $request->profile_status;
        $user_profile->festival_id              = $request->festival_id;
        $user_profile->user_id                  = \Auth::user()->id; 
        $user_profile->category_id              = $request->category_id;
        $user_profile->curator_id               = $request->curator_id;
        $user_profile->artist_type_id           = $request->artist_type_id;
        $user_profile->project_year             = $request->project_year;

        if($request->has('name') && $request->filled('name')) {
            $user_profile->name   = $request->name;
        }
        
        if($request->has('email') && $request->filled('email')) {
            $user_profile->email   = $request->email;
        }
        
        if($request->has('contact') && $request->filled('contact')) {
            $user_profile->contact   = $request->contact;
        }

        
        $user_profile->country_code             = $request->country_code;
        $user_profile->dob                      = $request->dob;
        $user_profile->permanent_address        = $request->permanent_address;
        $user_profile->city_id                  = $request->city_id;
        $user_profile->state_id                 = $request->state_id;
        $user_profile->country_id               = $request->country_id;
        $user_profile->pincode                  = $request->pincode;
        $user_profile->company_collective       = $request->company_collective;
        $user_profile->stage_name               = $request->stage_name;
        $user_profile->artist_bio               = $request->artist_bio;
        $user_profile->facebook_url             = $request->facebook_url;
        $user_profile->instagram_url            = $request->instagram_url;
        $user_profile->linkdin_url              = $request->linkdin_url;
        $user_profile->twitter_url              = $request->twitter_url;
        $user_profile->website                  = $request->website;        
        $user_profile->other_link               = $request->other_link;
        $user_profile->troup_size               = $request->troup_size;

        if ($request->hasFile('practice_image_1')) {

            $practice_image_1               = $request->file('practice_image_1');
            // $practice_image_1_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_1, $request->input('title'), 900, 900, true);
            $practice_image_1_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_1, 'practice_image_1');

            $user_profile->practice_image_1         = $practice_image_1_fileName;
        }

        if($request->has('practice_credit_1') && $request->filled('practice_credit_1')) {
            $user_profile->practice_credit_1   = $request->practice_credit_1;
        }

        if ($request->hasFile('practice_image_2')) {

            $practice_image_2               = $request->file('practice_image_2');
            // $practice_image_2_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_2, $request->input('title'), 900, 900, true);
            $practice_image_2_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_2, 'practice_image_2');
            $user_profile->practice_image_2         = $practice_image_2_fileName;
        }

        if($request->has('practice_credit_2') && $request->filled('practice_credit_2')) {
            $user_profile->practice_credit_2   = $request->practice_credit_2;
        }

        if ($request->hasFile('practice_image_3')) {

            $practice_image_3                       = $request->file('practice_image_3');
            // $practice_image_3_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_3, $request->input('title'), 900, 900, true);
            $practice_image_3_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_3, 'practice_image_3');

            $user_profile->practice_image_3                 = $practice_image_3_fileName;
        }

        if($request->has('practice_credit_3') && $request->filled('practice_credit_3')) {
            $user_profile->practice_credit_3   = $request->practice_credit_3;
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1                    = $request->file('profile_image_1');
            // $profile_image_1_fileName           = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('title'), 900, 900, true);
            $profile_image_1_fileName           = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_1, 'profile_image_1');

            $user_profile->profile_image_1              = $profile_image_1_fileName;
        }

        if($request->has('profile_credit_1') && $request->filled('profile_credit_1')) {
            $user_profile->profile_credit_1   = $request->profile_credit_1;
        }

        if ($request->hasFile('profile_image_2')) {

            $profile_image_2            = $request->file('profile_image_2');
            // $profile_image_2_fileName   = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_2, $request->input('title'), 900, 900, true);
            $profile_image_2_fileName   = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_2, 'profile_image_2');
            $user_profile->profile_image_2      = $profile_image_2_fileName;
        }

        if($request->has('profile_credit_2') && $request->filled('profile_credit_2')) {
            $user_profile->profile_credit_2   = $request->profile_credit_2;
        }

        $user_profile->has_serendipity_arts     = $request->has_serendipity_arts;
        $user_profile->year                     = $request->year;
        // dd($user_profile);
        $user_profile->save();

    }

    public function __updateUserProfile(Request $request, $id) {

        $user_profile = UserProfile::findOrFail($id);

        if ($user_profile->user_id) {
            $user_profile->user_id  = $user_profile->user_id;
        }else{
            $user_profile->user_id     = \Auth::user()->id;            
        }

        $user_profile->profile_status           = $request->profile_status;
        $user_profile->festival_id              = $request->festival_id;        
        $user_profile->category_id              = $request->category_id;
        $user_profile->curator_id               = $request->curator_id;
        $user_profile->artist_type_id           = $request->artist_type_id;
        $user_profile->project_year             = $request->project_year;

        if($request->has('name') && $request->filled('name')) {
            $user_profile->name   = $request->name;
        }
        
        if($request->has('email') && $request->filled('email')) {
            $user_profile->email   = $request->email;
        }
        
        if($request->has('contact') && $request->filled('contact')) {
            $user_profile->contact   = $request->contact;
        }

        
        $user_profile->country_code             = $request->country_code;
        $user_profile->dob                      = $request->dob;
        $user_profile->permanent_address        = $request->permanent_address;
        $user_profile->city_id                  = $request->city_id;
        $user_profile->state_id                 = $request->state_id;
        $user_profile->country_id               = $request->country_id;
        $user_profile->pincode                  = $request->pincode;
        $user_profile->company_collective       = $request->company_collective;
        $user_profile->stage_name               = $request->stage_name;
        $user_profile->artist_bio               = $request->artist_bio;
        $user_profile->facebook_url             = $request->facebook_url;
        $user_profile->instagram_url            = $request->instagram_url;
        $user_profile->linkdin_url              = $request->linkdin_url;
        $user_profile->twitter_url              = $request->twitter_url;
        $user_profile->website                  = $request->website;        
        $user_profile->other_link               = $request->other_link;
        $user_profile->troup_size               = $request->troup_size;

        if ($request->hasFile('practice_image_1')) {

            $practice_image_1               = $request->file('practice_image_1');
            // $practice_image_1_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_1, $request->input('title'), 900, 900, true);
            $practice_image_1_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_1, 'practice_image_1');

            $user_profile->practice_image_1         = $practice_image_1_fileName;
        }

        if($request->has('practice_credit_1') && $request->filled('practice_credit_1')) {
            $user_profile->practice_credit_1   = $request->practice_credit_1;
        }

        if ($request->hasFile('practice_image_2')) {

            $practice_image_2               = $request->file('practice_image_2');
            // $practice_image_2_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_2, $request->input('title'), 900, 900, true);
            $practice_image_2_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_2, 'practice_image_2');
            $user_profile->practice_image_2         = $practice_image_2_fileName;
        }

        if($request->has('practice_credit_2') && $request->filled('practice_credit_2')) {
            $user_profile->practice_credit_2   = $request->practice_credit_2;
        }

        if ($request->hasFile('practice_image_3')) {

            $practice_image_3                       = $request->file('practice_image_3');
            // $practice_image_3_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_3, $request->input('title'), 900, 900, true);
            $practice_image_3_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_3, 'practice_image_3');

            $user_profile->practice_image_3                 = $practice_image_3_fileName;
        }

        if($request->has('practice_credit_3') && $request->filled('practice_credit_3')) {
            $user_profile->practice_credit_3   = $request->practice_credit_3;
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1                    = $request->file('profile_image_1');
            // $profile_image_1_fileName           = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('title'), 900, 900, true);
            $profile_image_1_fileName           = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_1, 'profile_image_1');

            $user_profile->profile_image_1              = $profile_image_1_fileName;
        }

        if($request->has('profile_credit_1') && $request->filled('profile_credit_1')) {
            $user_profile->profile_credit_1   = $request->profile_credit_1;
        }

        if ($request->hasFile('profile_image_2')) {

            $profile_image_2            = $request->file('profile_image_2');
            // $profile_image_2_fileName   = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_2, $request->input('title'), 900, 900, true);
            $profile_image_2_fileName   = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_2, 'profile_image_2');
            $user_profile->profile_image_2      = $profile_image_2_fileName;
        }

        if($request->has('profile_credit_2') && $request->filled('profile_credit_2')) {
            $user_profile->profile_credit_2   = $request->profile_credit_2;
        }

        $user_profile->has_serendipity_arts     = $request->has_serendipity_arts;
        $user_profile->year                     = $request->year;
        // dd($user_profile);
        $user_profile->save();

    }

    public function __storeUser(Request $request) {

        

        $user = new UserProfile();
        $user->frontend_role_id       = $request->frontend_role_id;
        $user->category_id            = $request->category_id;
        $user->artist_type_id         = $request->artist_type_id;
        $user->curator_name           = $request->curator_name;

        if($request->has('name') && $request->filled('name')) {
            $user->name   = $request->name;
        }
        
        if($request->has('email') && $request->filled('email')) {
            $user->email   = $request->email;
        }
        
        if($request->has('contact') && $request->filled('contact')) {
            $user->contact   = $request->contact;
        }

        if($request->has('password') && $request->filled('password')) {
            $user->password     = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1              = $request->file('profile_image_1');
            $profile_image_1_fileName     = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('name'), 900, 900, true);
            $user->profile_image_1      = $profile_image_1_fileName;
        }        
        $user->save();

    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateUser(Request $request, $id) {

        $user                           = User::findOrFail($id);

        // dd($request->all());        
        
        $user->frontend_role_id       = $request->frontend_role_id;
        $user->category_id            = $request->category_id;
        $user->artist_type_id         = $request->artist_type_id;
        $user->curator_name           = $request->curator_name;

        if($request->has('name') && $request->filled('name')) {
            $user->name   = $request->name;
        }
        
        if($request->has('email') && $request->filled('email')) {
            $user->email   = $request->email;
        }
        
        if($request->has('contact') && $request->filled('contact')) {
            $user->contact   = $request->contact;
        }

        if($request->has('password') && $request->filled('password')) {
            $user->password     = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1              = $request->file('profile_image_1');
            $profile_image_1_fileName     = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('name'), 900, 900, true);
            $user->profile_image_1      = $profile_image_1_fileName;
        }        
        
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
    }

    public function __updateCategoryDetails_performing_arts(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail = UserCategoryDetail::where('user_id', $user_id)->first();
        
        $validateRules      = [
            'synopsis_description_of_the_performance'   => 'required', 
        ];

        // if(
        //     empty($userCategoryDetail->tech_rider) || 
        //     $request->hasFile('tech_rider')
        // ){

        //     $validateRules['tech_rider'] = 'required|mimetypes:application/pdf|max:10000';
        // }

        // $request->validate($validateRules, [
        //     'tech_rider.required' => 'Tech Rider file required',
        //     'tech_rider.mimetypes' => 'Only PDF file allowed',
        // ]);

        // if ($request->hasFile('tech_rider')) {

        //     $tech_rider                       = $request->file('tech_rider');
        //     $tech_rider_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $tech_rider, 'tech_rider');
        //     $userCategoryDetail->tech_rider   = $tech_rider_fileName;
        // }

        $userCategoryDetail->synopsis_description_of_the_performance   = $request->synopsis_description_of_the_performance;
        $userCategoryDetail->save();

        if($isAdminReferer){

            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_visual_arts(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail                                     = UserCategoryDetail::where('user_id', $user_id)->first();
        
        $validateRules      = [
            'has_this_project_show_before'   => 'required', 
        ];
        
        if(
            empty($userCategoryDetail->concept_note) || 
            $request->hasFile('concept_note')
        ){

            $validateRules['concept_note'] = 'required|mimetypes:application/pdf|max:10000';
        }

        $request->validate($validateRules, [
            'concept_note.required' => 'Concept Note file required',
            'concept_note.mimetypes' => 'Only PDF file allowed',
        ]);

        if ($request->hasFile('concept_note')) {

            $concept_note                       = $request->file('concept_note');
            $concept_note_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $concept_note, 'concept_note');
            $userCategoryDetail->concept_note   = $concept_note_fileName;
        }
        
        $userCategoryDetail->has_this_project_show_before   = $request->has_this_project_show_before;
        $userCategoryDetail->reference_image_link           = $request->reference_image_link;
        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_workshops(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail                                     = UserCategoryDetail::where('user_id', $user_id)->first();
        
        $validateRules      = [
            
        ];
        
        if(
            empty($userCategoryDetail->concept_note) || 
            $request->hasFile('concept_note')
        ){

            $validateRules['concept_note'] = 'required|mimetypes:application/pdf|max:10000';
        }

        $request->validate($validateRules, [
            'concept_note.required' => 'Concept Note file required',
            'concept_note.mimetypes' => 'Only PDF file allowed',
        ]);

        if ($request->hasFile('concept_note')) {

            $concept_note                       = $request->file('concept_note');
            $concept_note_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $concept_note, 'concept_note');
            $userCategoryDetail->concept_note   = $concept_note_fileName;
        }
        
        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_talks(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail                                     = UserCategoryDetail::where('user_id', $user_id)->first();
        
        $validateRules      = [
            
        ];
        
        if(
            empty($userCategoryDetail->concept_note) || 
            $request->hasFile('concept_note')
        ){

            $validateRules['concept_note'] = 'required|mimetypes:application/pdf|max:10000';
        }

        $request->validate($validateRules, [
            'concept_note.required' => 'Concept Note file required',
            'concept_note.mimetypes' => 'Only PDF file allowed',
        ]);

        if ($request->hasFile('concept_note')) {

            $concept_note                       = $request->file('concept_note');
            $concept_note_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $concept_note, 'concept_note');
            $userCategoryDetail->concept_note   = $concept_note_fileName;
        }
        
        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_culinary_arts(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail         = UserCategoryDetail::where('user_id', $user_id)->first();
        
        if ($request->hasFile('concept_note')) {

            $concept_note                       = $request->file('concept_note');
            $concept_note_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $concept_note, 'concept_note');
            $userCategoryDetail->concept_note   = $concept_note_fileName;
        }

        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_vendorssaf(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail                                         = UserCategoryDetail::where('user_id', $user_id)->first();
        $userCategoryDetail->project_id                             = $request->project_id;
        $userCategoryDetail->no_of_team_members                     = $request->no_of_team_members;
        $userCategoryDetail->brand_name                             = $request->brand_name;
        $userCategoryDetail->brand_bio                              = $request->brand_bio;
        
        if ($request->hasFile('brand_logo')) {

            $brand_logo                                             = $request->file('brand_logo');
            $brand_logo_fileName                                    = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $brand_logo, $request->input('title'), 900, 900, true);
            $userCategoryDetail->brand_logo                         = $brand_logo_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_1')) {

            $high_res_images_of_the_product_1                       = $request->file('high_res_images_of_the_product_1');
            $high_res_images_of_the_product_1_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_1, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_1   = $high_res_images_of_the_product_1_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_2')) {

            $high_res_images_of_the_product_2                       = $request->file('high_res_images_of_the_product_2');
            $high_res_images_of_the_product_2_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_2, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_2   = $high_res_images_of_the_product_2_fileName;
        }

        if ($request->hasFile('high_res_images_of_the_product_3')) {

            $high_res_images_of_the_product_3                       = $request->file('high_res_images_of_the_product_3');
            $high_res_images_of_the_product_3_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $high_res_images_of_the_product_3, $request->input('title'), 900, 900, true);
            $userCategoryDetail->high_res_images_of_the_product_3   = $high_res_images_of_the_product_3_fileName;
        }   

        $userCategoryDetail->youtube_link                           = $request->youtube_link;
        
        if ($request->hasFile('inventory_list')) {

            $inventory_list                                         = $request->file('inventory_list');
            $inventory_list_fileName                                = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $inventory_list, 'inventory_list');
            $userCategoryDetail->inventory_list                     = $inventory_list_fileName;
        }
        
        if ($request->hasFile('mrp_of_the_products')) {

            $mrp_of_the_products                                    = $request->file('mrp_of_the_products');
            $mrp_of_the_products_fileName                           = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $mrp_of_the_products, 'mrp_of_the_products');
            $userCategoryDetail->mrp_of_the_products                = $mrp_of_the_products_fileName;
        }

        $userCategoryDetail->hsn_sac_code                   = $request->hsn_sac_code;
        $userCategoryDetail->registration_fees              = $request->registration_fees;
        $userCategoryDetail->tables                         = $request->tables;
        $userCategoryDetail->chair                          = $request->chair;
        $userCategoryDetail->easel                          = $request->easel;
        $userCategoryDetail->fan                            = $request->fan;
        $userCategoryDetail->dustbin                        = $request->dustbin;
        $userCategoryDetail->lamp                           = $request->lamp;
        $userCategoryDetail->locks                          = $request->locks;
        $userCategoryDetail->extension_board                = $request->extension_board;
        $userCategoryDetail->other_requirement              = $request->other_requirement;

        $userCategoryDetail->has_part_of_other_project  = $request->has_part_of_other_project;
        $userCategoryDetail->other_project_category_id  = $request->other_project_category_id;
        $userCategoryDetail->other_project_id           = $request->other_project_id;
        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function __updateCategoryDetails_others(Request $request, $user_id = NULL){

        $isAdminReferer = true;
        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
            $isAdminReferer = false;
        }

        $userCategoryDetail                                     = UserCategoryDetail::where('user_id', $user_id)->first();
        
        $validateRules      = [
            
        ];
        
        if(
            empty($userCategoryDetail->concept_note) || 
            $request->hasFile('concept_note')
        ){

            $validateRules['concept_note'] = 'required|mimetypes:application/pdf|max:10000';
        }

        $request->validate($validateRules, [
            'concept_note.required' => 'Concept Note file required',
            'concept_note.mimetypes' => 'Only PDF file allowed',
        ]);

        if ($request->hasFile('concept_note')) {

            $concept_note                       = $request->file('concept_note');
            $concept_note_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $concept_note, 'concept_note');
            $userCategoryDetail->concept_note   = $concept_note_fileName;
        }
        
        $userCategoryDetail->save();

        if($isAdminReferer){
            
            \Flash::success('Category details updated successfully.');
            return \Redirect::route('admin.user.index');
        }

        \Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    /**
     * Store a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __storeAccountDetails(Request $request){        

        $userAccountDetail                          = new UserAccountDetail();

        $userAccountDetail->banking_status               = $request->banking_status;
        $userAccountDetail->user_id                      = \Auth::user()->id;
        $userAccountDetail->profile_id                   = $request->profile_id;
        $userAccountDetail->name                         = $request->name;
        $userAccountDetail->permanent_address            = $request->permanent_address;
        $userAccountDetail->pincode                      = $request->pincode;
        $userAccountDetail->country_id                   = $request->country_id;
        $userAccountDetail->state_id                     = $request->state_id;
        $userAccountDetail->city_id                      = $request->city_id;        
        $userAccountDetail->account_number               = $request->account_number;
        $userAccountDetail->bank_holder_name             = $request->bank_holder_name;
        $userAccountDetail->bank_name                    = $request->bank_name;
        $userAccountDetail->branch_address               = $request->branch_address;
        $userAccountDetail->ifsc_code                    = $request->ifsc_code;
        $userAccountDetail->iban_number                  = $request->iban_number;
        $userAccountDetail->swift_code                   = $request->swift_code;
        $userAccountDetail->corresponding_bank_details   = $request->corresponding_bank_details;
        $userAccountDetail->residency                    = $request->residency;
        $userAccountDetail->pancard_link_with_adhar      = $request->pancard_link_with_adhar;

        if ($request->hasFile('cancel_cheque_image')) {

            $cancel_cheque_image                = $request->file('cancel_cheque_image');
            $cancel_cheque_image_fileName       = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $cancel_cheque_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->cancel_cheque_image             = $cancel_cheque_image_fileName;
        }

        $userAccountDetail->pancard_number      = $request->pancard_number;

        if ($request->hasFile('pancard_image')) {

            $pancard_image                      = $request->file('pancard_image');
            $pancard_image_fileName             = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $pancard_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->pancard_image               = $pancard_image_fileName;
        }

        $userAccountDetail->has_gst_applicable      = $request->has_gst_applicable;
        $userAccountDetail->gst_number              = $request->gst_number;

        if ($request->hasFile('gst_certificate_file')) {

            $gst_certificate_file               = $request->file('gst_certificate_file');

            $gst_certificate_file_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $gst_certificate_file, 'gst_certificate_file');

            $userAccountDetail->gst_certificate_file        = $gst_certificate_file_fileName;
        }

        $userAccountDetail->save();

    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateAccountDetails(Request $request, $id){        

        $userAccountDetail                          = UserAccountDetail::findOrFail($id);

        if ($request->user_id) {
            $userAccountDetail->user_id  = $request->user_id;
        }else{
            $userAccountDetail->user_id     = \Auth::user()->id;            
        }
        
        $userAccountDetail->banking_status                = $request->banking_status;
        $userAccountDetail->profile_id                    = $request->profile_id;
        $userAccountDetail->name                          = $request->name;
        $userAccountDetail->permanent_address             = $request->permanent_address;
        $userAccountDetail->pincode                       = $request->pincode;
        $userAccountDetail->country_id                    = $request->country_id;
        $userAccountDetail->state_id                      = $request->state_id;
        $userAccountDetail->city_id                       = $request->city_id;
        $userAccountDetail->account_number                = $request->account_number;
        $userAccountDetail->bank_holder_name              = $request->bank_holder_name;
        $userAccountDetail->bank_name                     = $request->bank_name;
        $userAccountDetail->branch_address                = $request->branch_address;
        $userAccountDetail->ifsc_code                     = $request->ifsc_code;
        $userAccountDetail->residency                     = $request->residency;
        $userAccountDetail->iban_number                   = $request->iban_number;
        $userAccountDetail->swift_code                    = $request->swift_code;
        $userAccountDetail->corresponding_bank_details    = $request->corresponding_bank_details;
        $userAccountDetail->pancard_link_with_adhar       = $request->pancard_link_with_adhar;

        if ($request->hasFile('cancel_cheque_image')) {

            $cancel_cheque_image                = $request->file('cancel_cheque_image');
            $cancel_cheque_image_fileName       = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $cancel_cheque_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->cancel_cheque_image             = $cancel_cheque_image_fileName;
        }

        $userAccountDetail->pancard_number      = $request->pancard_number;

        if ($request->hasFile('pancard_image')) {

            $pancard_image                      = $request->file('pancard_image');
            $pancard_image_fileName             = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $pancard_image, 'pancard_image', 900, 900, true);
            $userAccountDetail->pancard_image               = $pancard_image_fileName;
        }

        $userAccountDetail->has_gst_applicable      = $request->has_gst_applicable;
        $userAccountDetail->gst_number              = $request->gst_number;

        if ($request->hasFile('gst_certificate_file')) {

            $gst_certificate_file               = $request->file('gst_certificate_file');

            $gst_certificate_file_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $gst_certificate_file, 'gst_certificate_file');

            $userAccountDetail->gst_certificate_file        = $gst_certificate_file_fileName;
        }

        $userAccountDetail->save();

    }

}