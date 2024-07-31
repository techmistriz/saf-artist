<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;
use App\Rules\MaxWordsRule;

class UserRequest extends FormRequest
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
            
        ];
    }

    public function messages()
    {
        return [
            'permanent_address.required' => 'Address field required.'
        ];
    }
}
