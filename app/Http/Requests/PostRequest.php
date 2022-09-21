<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'color' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'summary' => 'present',
            'content' => 'required',
            'is_pinned' => 'boolean',
            'tweet_url' => 'nullable|string',
            'external_url' => 'required_if:type,Link',
            'published_at' => 'date',
            'status' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('Title is required.'),
            'content.required' => __('Content is required.'),
            'type.required' => __('Type is required.'),
            'external_url.required_if' => __('External URL is required.'),
        ];
    }
}
