<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // protected $fillable = [
    //     // 'title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
