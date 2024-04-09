<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id 					= $this->input('id', 0);
        $password_rule 			= 'required|string|min:6|max:12';
        $password_confirm_rule 	= 'required|same:password';
        
        if($id != 0) {
        	$password_rule = '';
        	$password_confirm_rule = '';
        }

     	return [
            'name' 					=> 'required',            
         	'email' 				=> 'required | ' . Rule::unique('users')->ignore($id, 'id'),
          //   'password' 				=> $password_rule,          
          //   'password_confirm' 		=> $password_confirm_rule,
            'category_id'			=> 'required',
            'frontend_role_id'           => 'required',
            // 'gender' 				=> 'required',
            'contact' 				=> 'required',
            // 'terms' 				=> 'required',
          //   'age' 					=> 'required',
            // 'dob' 					=> 'required',
          //   'permanent_address' 	=> 'required',
          //   'pa_city' 				=> 'required',
          //   'pa_state' 				=> 'required',
          //   'pa_country' 			=> 'required',
          //   'pa_pincode' 			=> 'required',
          //   // 'current_address' 		=> 'required',
          //   // 'ca_city' 				=> 'required',
          //   // 'ca_state' 				=> 'required',
          //   // 'ca_country' 			=> 'required',
          //   // 'ca_pincode' 			=> 'required',
          //   'address_proof_type'	=> 'required',
          //   'address_proof_image'	=> 'required',
          //   'address_proof_image'	=> 'required',
          //   'stage_name' 			=> 'required',
          //   'artist_bio' 			=> 'required',
          //   'facebook_username'		=> 'required',
          //   'facebook_url' 			=> 'required',
          //   'instagram_urername'	=> 'required',
          //   'instagram_url'			=> 'required',
          //   'linkdin_username'		=> 'required',
          //   'linkdin_url'			=> 'required',
          //   'twitter_username'		=> 'required',
          //   'twitter_url'			=> 'required',
          //   'website' 				=> 'required',
          //   'practice_image_1' 		=> 'required',
          //   'practice_image_2' 		=> 'required',
          //   'practice_image_3' 		=> 'required',
          //   'profile_image_1' 		=> 'required',
          //   'profile_image_2'		=> 'required',
          //   'has_serendipity_arts'	=> 'required',
          //   'other_link'			=> 'required',
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
