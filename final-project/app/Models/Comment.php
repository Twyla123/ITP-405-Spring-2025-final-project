<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'recipe_id'];

    // A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A comment belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}