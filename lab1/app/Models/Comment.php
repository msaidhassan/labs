<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    // Define the polymorphic relation
    public function commentable()
    {
        return $this->morphTo();
    }

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
