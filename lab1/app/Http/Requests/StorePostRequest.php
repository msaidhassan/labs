<?php

namespace App\Http\Requests;

use App\Rules\NoPostKeyword;
use App\Rules\MaxPostsPerUser;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'unique:posts,title', new NoPostKeyword, new MaxPostsPerUser],
            'content' => ['required', 'min:10'],
            'posted_by' => ['required', 'exists:users,id'],
            'image' => ['nullable', 'image']
        ];
    }
}
