<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class UserCategoryDetailsRequest extends FormRequest
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
     	return [
            // 'project_name' 						=> 'required',            
            // 'no_of_people_in_group'				=> 'required',
            // 'form_genre' 						=> 'required',
            // 'organisation' 						=> 'required',
            // 'light_designer_needed'				=> 'required',
            // 'sound_designer_needed'				=> 'required',
            // 'iprs_license_required' 			=> 'required',
            // 'space_visual_design_requirements'	=> 'required',
            // 'biodata' 							=> 'required',
            // 'tech_rider' 						=> 'required',
            
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
