<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    protected $fillable = [
        'content', 'user_id', 'discussion_id'
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();

        $likers = array();

        foreach ($this->likes as $like) :
            array_push($likers, $like->user_id);
        endforeach;

        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}
