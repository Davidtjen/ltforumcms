<?php

namespace App\Http\Controllers;

use App\Like;
use App\Notifications\YourReplyIsBestAnswer;
use App\Notifications\YourReplyLiked;
use App\Reply;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    public function like($id)
    {
        $like = Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        $likedReplyDiscussion = $like->reply->discussion;

        if ($like){
            $like->reply->user->notify(new YourReplyLiked($likedReplyDiscussion));
        }

        Session::flash('success', 'You liked the reply.');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();

        $like->delete();

        Session::flash('success', 'You unliked the reply.');

        return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);

        $reply->best_answer = 1;
        $reply->save();

        $reply->user->points += 25;
        $reply->user->save();

        $d = $reply->discussion;

        $replyUserId = $reply->user->id;
        $discussionUserId = $reply->discussion->user->id;

        // If the reply user is not the user of the discussion, send notification
        if ($replyUserId != $discussionUserId) {
            // Notify discussion owner that a reply is added to discussion
            $reply->user->notify(new YourReplyIsBestAnswer($d));
        }

        Session::flash('success', 'Reply has been marked as the best answer.');

        return redirect()->back();

        /*$reply = Reply::id();
        $reply_with_best_answer = Reply::where('best_answer', 1)->first();

        $best_answers_list = array();

        foreach ( $reply_with_best_answer as $r) :
            array_push($r, $best_answers_list);
        endforeach;

        if (in_array($reply->best_answer, $best_answers_list)) {
            return true;
        } else {
            return false;
        }*/
    }

    public function edit($id)
    {
        return view('replies.edit', ['reply' => Reply::find($id)]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $reply = Reply::find($id);
        $reply->content = request()->content;
        $reply->save();

        Session::flash('success', 'Reply updated');
        return redirect()->route('discussions', ['slug' => $reply->discussion->slug]);
    }
}
