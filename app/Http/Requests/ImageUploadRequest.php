<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImageUploadRequest extends FormRequest
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
        $size = config('media-library.max_file_size');

        return [
            'image' => [
                'required',
                'mimes:jpg,jpeg,png,gif,svg',
                'max:'.$size,
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // make sure we return the proper error for easymde
        throw new HttpResponseException(
            response()->json(['error' => $validator->errors()->first('image')],
                422)
        );
    }
}
