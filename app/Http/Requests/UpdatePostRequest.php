<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends FormRequest
{
    public function getPost()
    {
        return Post::findOrFail($this->route('post'));
    }

    public function authorize(): bool
    {
        return Gate::allows('manage', $this->getPost());
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:100',
            'body' => 'sometimes|required|string|min:5',
            'excerpt' => 'nullable|string|min:3|max:255',
        ];
    }

    public function save()
    {
        return tap($this->getPost())->update($this->validated());
    }
}
