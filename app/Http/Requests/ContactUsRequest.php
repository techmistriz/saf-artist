<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class ContactUsRequest extends FormRequest
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

    	$id = $this->input('id', 0);
     	return [
            // 'email'			=> 'required | email | ' . Rule::unique('contact_us')->ignore($id, 'id'),
            'email'			=> 'required|email',
            'name' 			=> 'required',
            'contact' 		=> 'required',
            'message' 		=> 'required'
        ];
    }

    public function messages()
    {
        return [
           	
        ];
    }
}
