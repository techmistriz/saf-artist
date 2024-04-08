<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class VenueRequest extends FormRequest
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
            'title' 			=> 'required',            
            'description' 		=> 'required',            
            'short_description' => 'required',            
            // 'featured_image' 	=> 'required',            
            'google_map_url' 	=> 'required',            
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
