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
            // 'name' 						=> 'required',            
            // 'permanent_address'			=> 'required',
            // 'address_proof_image'		=> 'required|mimes:jpeg,png,jpg',
            'account_number' 			=> 'required',
            'confirm_account_number'	=> 'required|same:account_number',
            // 'bank_holder_number'		=> 'required',
            // 'bank_name'					=> 'required',
            // 'branch_address' 			=> 'required',
            // 'ifsc_code'					=> 'required',
            // 'cancel_cheque_image' 		=> 'required|mimes:jpeg,png,jpg',
            // 'pancard_number' 			=> 'required',
            // 'pancard_image' 			=> 'required|mimes:jpeg,png,jpg',
            // 'has_gst_number' 			=> 'required',
            // 'gst_certificate_file'		=> 'required|mimes:jpeg,png,jpg,doc,docx,pdf|max:5120',
            // 'hsn_sac_code' 				=> 'required',
            // 'product_inventory_file' 	=> 'required|mimes:jpeg,png,jpg,doc,docx,pdf|max:5120',
            
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
