<?php

namespace App\Http\Requests;

use App\Rules\NoPostKeyword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'unique:posts,title,' . $this->id, new NoPostKeyword],
            'content' => ['required', 'min:10'],
            'posted_by' => ['required', 'exists:users,id'],
            'image' => ['nullable', 'image']
        ];
    }
}
