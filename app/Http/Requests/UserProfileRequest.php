<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;
use App\Rules\MaxWordsRule;

class UserProfileRequest extends FormRequest
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
            'project_year' 	=> 'required',
            'festival_id' 			=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'permanent_address.required' => 'Address field required.'
        ];
    }
}
