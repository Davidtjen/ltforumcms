<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id', 'channel_id', 'slug'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }

    public function is_being_watched_by_auth_user()
    {
        // save this auth user id in variable for search later(the needle)
        $id = Auth::id();

        // for now you create an empty array
        //(the haystack) in which you will search for the id(the needle)
        $watchers_ids = array();

        // for every watchers on the selected discussion(this->watchers function), you save
        // the id in the watchers_ids array
        foreach ($this->watchers as $w):
            array_push($watchers_ids, $w->user_id);
        endforeach;

        // now you check if the id(needle) is present in the
        // watchers_ids(haystack), if its there you return true(success)
        // if not you return false
        if (in_array($id, $watchers_ids)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBestAnswer()
    {
        $result = false;

        foreach ($this->replies as $reply) {
            if ($reply->best_answer) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
