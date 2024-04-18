<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class HotelBookingRequest extends FormRequest
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
            'accomodation'            => 'required',
            'check_in_date'             => 'required',
            'check_out_date'          => 'required',
            // 'dob'              => 'required',
        ];
    }

    public function messages()
    {
        return [
           	
        ];
    }
}
