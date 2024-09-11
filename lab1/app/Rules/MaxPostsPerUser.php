<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxPostsPerUser implements Rule
{
    public function passes($attribute, $value)
    {
        return \App\Models\Post::where('posted_by', auth()->id())->count() < 3;
    }

    public function message()
    {
        return 'You can only create up to 3 posts.';
    }
}

