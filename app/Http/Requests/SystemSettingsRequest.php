<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class SystemSettingsRequest extends FormRequest
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
            'name'			=> 'required | ' . Rule::unique('system_settings')->ignore($id, 'id'),
            'value' 		=> 'required'
        ];
    }

    public function messages()
    {
        return [
           	
        ];
    }
}
