<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // A recipe has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // A recipe has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}