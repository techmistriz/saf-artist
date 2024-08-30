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
        $user_id = \Auth::user()->id;

        return [
            'festival_id' => [
                'required',
                Rule::unique('user_profiles')->ignore($id, 'id')->where(function ($query) use ($user_id) {
                    return $query->where('user_id', $user_id);
                }),
            ],
            'project_year' => 'required',
            'practice_image_1' => 'image|mimes:jpeg,png,jpg|max:2048',
            'practice_image_2' => 'image|mimes:jpeg,png,jpg|max:2048',
            'practice_image_3' => 'image|mimes:jpeg,png,jpg|max:2048',
            'profile_image_1' => 'image|mimes:jpeg,png,jpg|max:2048',
            'profile_image_2' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [            
            
            'practice_image_1.max' => 'Practice image 1  must not be greater than 2 MB.',
           
            'practice_image_2.max' => 'Practice image 2  must not be greater than 2 MB.',
            
            'practice_image_3.max' => 'Practice image 3  must not be greater than 2 MB.',
            
            'profile_image_1.max' => 'Profile image 1  must not be greater than 2 MB.',
            
            'profile_image_2.max' => 'Profile image 2  must not be greater than 2 MB.',
        ];
    }

}
