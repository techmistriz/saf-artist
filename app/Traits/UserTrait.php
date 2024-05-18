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
     * Store a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __storeUser(Request $request) {

        $user = new User();
        // dd($request->all()); 
        $user->frontend_role_id         = \Auth::user()->frontend_role_id;        
        $user->category_id              = $request->category_id;
        $user->curator_name             = $request->curator_name;
        $user->artist_type_id           = $request->artist_type_id;
        $user->year                     = $request->year;
        $user->festival                 = $request->festival;
        $user->project_id               = $request->project_id;

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
        
        if($request->has('project_id') && $request->filled('project_id')) {
            $user->project_id   = $request->project_id;
        }
        
        if($request->has('no_of_people_in_group') && $request->filled('no_of_people_in_group')) {
            $user->no_of_people_in_group     = $request->no_of_people_in_group;
        }
        
        if($request->has('organisation') && $request->filled('organisation')) {
            $user->organisation     = $request->organisation;
        }

        $user->gender                   = $request->gender;
        $user->country_code             = $request->country_code;
        $user->dob                      = $request->dob;
        $user->permanent_address        = $request->permanent_address;
        $user->pa_city_id               = $request->pa_city_id;
        $user->pa_city_other            = $request->pa_city_other;
        $user->pa_state_id              = $request->pa_state_id;
        $user->pa_country_id            = $request->pa_country_id;
        $user->pa_country_other         = $request->pa_country_other;
        $user->pa_pincode               = $request->pa_pincode;
        $user->company_collective       = $request->company_collective;
        $user->stage_name               = $request->stage_name;
        $user->artist_bio               = $request->artist_bio;
        $user->facebook_url             = $request->facebook_url;
        $user->instagram_url            = $request->instagram_url;
        $user->linkdin_url              = $request->linkdin_url;
        $user->twitter_url              = $request->twitter_url;
        $user->website                  = $request->website;
        
        if ($request->hasFile('practice_image_1')) {

            $practice_image_1               = $request->file('practice_image_1');
            // $practice_image_1_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_1, $request->input('title'), 900, 900, true);
            $practice_image_1_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_1, 'practice_image_1');

            $user->practice_image_1         = $practice_image_1_fileName;
        }

        if($request->has('practice_credit_1') && $request->filled('practice_credit_1')) {
            $user->practice_credit_1   = $request->practice_credit_1;
        }

        if ($request->hasFile('practice_image_2')) {

            $practice_image_2               = $request->file('practice_image_2');
            // $practice_image_2_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_2, $request->input('title'), 900, 900, true);
            $practice_image_2_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_2, 'practice_image_2');
            $user->practice_image_2         = $practice_image_2_fileName;
        }

        if($request->has('practice_credit_2') && $request->filled('practice_credit_2')) {
            $user->practice_credit_2   = $request->practice_credit_2;
        }

        if ($request->hasFile('practice_image_3')) {

            $practice_image_3                       = $request->file('practice_image_3');
            // $practice_image_3_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_3, $request->input('title'), 900, 900, true);
            $practice_image_3_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_3, 'practice_image_3');

            $user->practice_image_3                 = $practice_image_3_fileName;
        }

        if($request->has('practice_credit_3') && $request->filled('practice_credit_3')) {
            $user->practice_credit_3   = $request->practice_credit_3;
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1                    = $request->file('profile_image_1');
            // $profile_image_1_fileName           = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('title'), 900, 900, true);
            $profile_image_1_fileName           = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_1, 'profile_image_1');

            $user->profile_image_1              = $profile_image_1_fileName;
        }

        if($request->has('profile_credit_1') && $request->filled('profile_credit_1')) {
            $user->profile_credit_1   = $request->profile_credit_1;
        }

        if ($request->hasFile('profile_image_2')) {

            $profile_image_2            = $request->file('profile_image_2');
            // $profile_image_2_fileName   = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_2, $request->input('title'), 900, 900, true);
            $profile_image_2_fileName   = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_2, 'profile_image_2');
            $user->profile_image_2      = $profile_image_2_fileName;
        }

        if($request->has('profile_credit_2') && $request->filled('profile_credit_2')) {
            $user->profile_credit_2   = $request->profile_credit_2;
        }

        $user->has_serendipity_arts     = $request->has_serendipity_arts;
        $user->year                     = $request->year;
        $user->other_link               = $request->other_link;
        $user->troup_size               = $request->troup_size;
        // dd($user);
        $user->save();

    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateProfile(Request $request, $id) {

        $user                           = User::findOrFail($id);

        // dd($request->all());        
        
        $user->category_id              = $request->category_id;
        $user->curator_name             = $request->curator_name;
        $user->artist_type_id           = $request->artist_type_id;

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
        
        if($request->has('project_id') && $request->filled('project_id')) {
            $user->project_id   = $request->project_id;
        }
        
        if($request->has('no_of_people_in_group') && $request->filled('no_of_people_in_group')) {
            $user->no_of_people_in_group     = $request->no_of_people_in_group;
        }
        
        if($request->has('organisation') && $request->filled('organisation')) {
            $user->organisation     = $request->organisation;
        }

        $user->gender                   = $request->gender;
        $user->country_code             = $request->country_code;
        $user->dob                      = $request->dob;
        $user->permanent_address        = $request->permanent_address;
        $user->pa_city_id               = $request->pa_city_id;
        $user->pa_city_other            = $request->pa_city_other;
        $user->pa_state_id              = $request->pa_state_id;
        $user->pa_country_id            = $request->pa_country_id;
        $user->pa_country_other         = $request->pa_country_other;
        $user->pa_pincode               = $request->pa_pincode;
        $user->company_collective       = $request->company_collective;
        $user->stage_name               = $request->stage_name;
        $user->artist_bio               = $request->artist_bio;
        $user->facebook_url             = $request->facebook_url;
        $user->instagram_url            = $request->instagram_url;
        $user->linkdin_url              = $request->linkdin_url;
        $user->twitter_url              = $request->twitter_url;
        $user->website                  = $request->website;
        
        if ($request->hasFile('practice_image_1')) {

            $practice_image_1               = $request->file('practice_image_1');
            // $practice_image_1_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_1, $request->input('title'), 900, 900, true);
            $practice_image_1_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_1, 'practice_image_1');

            $user->practice_image_1         = $practice_image_1_fileName;
        }

        if($request->has('practice_credit_1') && $request->filled('practice_credit_1')) {
            $user->practice_credit_1   = $request->practice_credit_1;
        }

        if ($request->hasFile('practice_image_2')) {

            $practice_image_2               = $request->file('practice_image_2');
            // $practice_image_2_fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_2, $request->input('title'), 900, 900, true);
            $practice_image_2_fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_2, 'practice_image_2');
            $user->practice_image_2         = $practice_image_2_fileName;
        }

        if($request->has('practice_credit_2') && $request->filled('practice_credit_2')) {
            $user->practice_credit_2   = $request->practice_credit_2;
        }

        if ($request->hasFile('practice_image_3')) {

            $practice_image_3                       = $request->file('practice_image_3');
            // $practice_image_3_fileName              = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $practice_image_3, $request->input('title'), 900, 900, true);
            $practice_image_3_fileName              = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $practice_image_3, 'practice_image_3');

            $user->practice_image_3                 = $practice_image_3_fileName;
        }

        if($request->has('practice_credit_3') && $request->filled('practice_credit_3')) {
            $user->practice_credit_3   = $request->practice_credit_3;
        }

        if ($request->hasFile('profile_image_1')) {

            $profile_image_1                    = $request->file('profile_image_1');
            // $profile_image_1_fileName           = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_1, $request->input('title'), 900, 900, true);
            $profile_image_1_fileName           = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_1, 'profile_image_1');

            $user->profile_image_1              = $profile_image_1_fileName;
        }

        if($request->has('profile_credit_1') && $request->filled('profile_credit_1')) {
            $user->profile_credit_1   = $request->profile_credit_1;
        }

        if ($request->hasFile('profile_image_2')) {

            $profile_image_2            = $request->file('profile_image_2');
            // $profile_image_2_fileName   = ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image_2, $request->input('title'), 900, 900, true);
            $profile_image_2_fileName   = FileUploadHelper::UploadFile(self::$moduleConfig['imageUploadFolder'], $profile_image_2, 'profile_image_2');
            $user->profile_image_2      = $profile_image_2_fileName;
        }

        if($request->has('profile_credit_2') && $request->filled('profile_credit_2')) {
            $user->profile_credit_2   = $request->profile_credit_2;
        }

        $user->has_serendipity_arts     = $request->has_serendipity_arts;
        $user->year                     = $request->year;
        $user->other_link               = $request->other_link;
        $user->troup_size               = $request->troup_size;
        //dd($user);
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
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateAccountDetails(Request $request, $user_id = NULL){

        if(empty($user_id)){

            $user_id    = \Auth::user()->id;
        }

        $userAccountDetail                          = UserAccountDetail::where('user_id', $user_id)->first();
        $userAccountDetail->name                    = $request->name;
        $userAccountDetail->permanent_address       = $request->permanent_address;
        $userAccountDetail->pincode                 = $request->pincode;
        $userAccountDetail->country_id              = $request->country_id;
        $userAccountDetail->state_id                = $request->state_id;
        $userAccountDetail->city_id                 = $request->city_id;

        $userAccountDetail->account_number          = $request->account_number;
        $userAccountDetail->bank_holder_name        = $request->bank_holder_name;
        $userAccountDetail->bank_name               = $request->bank_name;
        $userAccountDetail->branch_address          = $request->branch_address;
        $userAccountDetail->ifsc_code               = $request->ifsc_code;
        $userAccountDetail->pancard_link_with_adhar = $request->pancard_link_with_adhar;

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