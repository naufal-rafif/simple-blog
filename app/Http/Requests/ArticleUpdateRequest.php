<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:110',
            'image' => 'image|mimes:jpg,png,jpeg|max:300',
            'tag' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "title can't be null",
            'title.max' => 'maximum character is 110',
            'tag.required' => "tag can't be null",
            'content.required' => "content can't be null",
            'image.mimes' => 'image format must be png, jpg, or jpeg.',
            'image.max' => 'maximum size is 300kb'
        ];
    }
}
