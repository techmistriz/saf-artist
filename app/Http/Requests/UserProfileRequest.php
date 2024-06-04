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
            'dob' 					=> $this->input('frontend_role_id') == '8' ? 'required' : '',
            'permanent_address' 	=> 'required',
            'pa_country_id' 			=> 'required',
            'pa_pincode' 			=> 'required',
            'artist_bio' => $this->input('frontend_role_id') == '8' ? ['required', new MaxWordsRule(150)] : [],
            'max_allowed_member'         => $this->input('frontend_role_id') == '9' ? 'required' : '',
        ];
    }

    public function messages()
    {
        return [
            'permanent_address.required' => 'Address field required.'
        ];
    }
}
