<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class UserAccountDetailsRequest extends FormRequest
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
            'profile_id'                  => 'required',
            'account_number' 			=> 'required',
            'confirm_account_number'	=> 'required|same:account_number',
            'ifsc_code'   => $this->input('residency') == 'Domestic' ? 'required|regex:/^[A-Z0-9]{11}$/' : '',
            'cancel_cheque_image' => '|image|mimes:jpeg,png,jpg|max:5120',
            'pancard_image' => '|image|mimes:jpeg,png,jpg|max:5120',
            'gst_certificate_file' => '|mimes:jpeg,png,jpg,pdf|max:5120',
            
        ];
    }

    public function messages()
    {
        return [
            'cancel_cheque_image.max' => 'Cancel cheque image  must not be greater than 5 MB.',
            'pancard_image.max' => 'Pancard image  must not be greater than 5 MB.',
            'gst_certificate_file.max' => 'GST Certificate  must not be greater than 5 MB.',
        ];
    }
}
