<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class ProfileMemberRequest extends FormRequest
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
        $id                 = $this->input('id', 0);
        return [
            'email'            => 'required|'.Rule::unique('profile_members')->ignore($id, 'id'),
            'name'             => 'required',
            'contact'          => 'required',
            'dob'              => 'required',
            'room_sharing'              => 'required',
        ];
    }

    public function messages()
    {
        return [
           	
        ];
    }
}
