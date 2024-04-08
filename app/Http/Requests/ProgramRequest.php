<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidHost;;

class ProgramRequest extends FormRequest
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
            'name' 			=> 'required',            
            'category_id' 		=> 'required',            
            'venue_id' => 'required',            
            // 'featured_image' 	=> 'required',            
            'discipline_id' 	=> 'required',            
            'total_seats' 	=> 'required',            
            'vip_seats' 	=> 'required',            
            'event_date' 	=> 'required',            
            'from_time' 	=> 'required',            
            'to_time' 	=> 'required',            
            'disclaimer' 	=> 'required',            
            'amount' 	=> 'required',            
            'curator_id' 	=> 'required',            
            // 'program_tag_ids' 	=> 'required',            
            'description' 	=> 'required',            
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
