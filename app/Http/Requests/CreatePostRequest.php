<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (auth()->user()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'body' => 'required|string|min:5',
            'user_id' => 'nullable',
            'slug' => 'nullable',
            'excerpt' => 'required',
        ];
    }

    public function save()
    {
        return tap($this->post())->create($this->validated());
    }
}
