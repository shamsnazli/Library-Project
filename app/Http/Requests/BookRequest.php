<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'required',
            'description' => 'string',
            'published_number' => 'numeric',
            'publisher_id' => 'required',
            'published_year' => 'numeric|min:1990|max:2020',
            'category_id' => 'required',
            'author_id' => 'required',

        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'title is required',
            'title.string' => 'Book title is a string',
            'image.required' => 'You must send a book image',
            'published_number.numeric' => 'The field of Published number is a number',
            'publisher_id.required' => 'You must choose a Publisher',
            'description.string' => 'Book description is a string',
            'published_year.numeric' => 'The field of Published Year is a number',
            'published_year.min:1990' => 'Wrong value',
            'published_year.max:2020' => 'Wrong value',
            'author_id.required' => 'You must choose an Author',
            'category_id.required' => 'You must choose a Category',
        ];
    }
}
