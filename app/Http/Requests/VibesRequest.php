<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class VibesRequest extends FormRequest
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
            'title' 				=> 'required',            
            'description' 			=> 'required',            
            'short_description' 	=> 'required',            
            // 'featured_image' 	=> 'required',            
            'external_link' 		=> 'required',
            'partner_type_id'     	=> 'required',            
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
