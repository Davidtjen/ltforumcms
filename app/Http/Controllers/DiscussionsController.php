<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Like;
use App\Notifications\NewReplyAddedToDiscussionYourWatching;
use App\Notifications\NewReplyAddedToYourDiscussion;
use App\Reply;
use App\User;
use App\Watcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->only('create', 'store', 'reply', 'edit', 'update');
    }

    public function create()
    {
        return view('discuss');
    }

    public function store()
    {
        $r = request();

        $this->validate(request(), [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required',
        ]);

        $discussion = Discussion::create([
            'title' => $r->title,
            'content' => $r->content,
            'channel_id' => $r->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($r->title)
        ]);

        Session::flash('success', 'Discussion successfully created');

        return redirect()->route('discussions', ['slug' => $discussion->slug]);

    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies->where('best_answer', 1)->first();

        return view('discussions.show')
            ->with('d', $discussion)
            ->with('best_answer', $best_answer);
    }

    public function reply($id)
    {
        $this->validate(request(), [
            'reply' => 'required|max:2450'
        ]);

        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        $reply->user->points += 5;
        $reply->user->save();

        // dd($reply->user->name . "  " . $d->user->name);
        $replyUserId = $reply->user->id;
        $discussionUserId = $d->user->id;

        // If the reply user is not the owner, send notification
        if ($replyUserId != $discussionUserId) {
            // Notify discussion owner that a reply is added to discussion
            $d->user->notify(new NewReplyAddedToYourDiscussion($d));
        }

        $watchersList = array();

        foreach ($d->watchers as $watcher):
            array_push($watchersList, User::find($watcher->user_id));
        endforeach;

        Notification::send($watchersList, new NewReplyAddedToDiscussionYourWatching($d));

        Session::flash('success', 'Replied to discussion');

        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);

        $d->content = request()->content;

        $d->save();

        Session::flash('success', 'Discussion Updated');

        return redirect()->route('discussions', ['slug' => $d->slug]);
    }

    public function destroy($id)
    {
        // Find the discussion
        $discussion = Discussion::find($id);

        // Find the watchers that belong to this discussion
        $discusWatchers = array();
        foreach ($discussion->watchers as $watcher):
            array_push($discusWatchers, $watcher->id);
        endforeach;

        // Find the replies that belong to this discussion
        $discusReplies = array();
        foreach ($discussion->replies as $reply):
            array_push($discusReplies, $reply->id);
        endforeach;

        // Find the likes that belong to above replies
        $likesForTheReplies = array();
        foreach ($discusReplies as $replyLike):
            $likes = Like::where('reply_id', '=', $replyLike)->pluck('id')->toArray();
            foreach ($likes as $replyLike):
                array_push($likesForTheReplies, $replyLike);
            endforeach;
        endforeach;

        // First remove the likes
        foreach ($likesForTheReplies as $replyLike) {
            Like::where('id', '=', $replyLike)->delete();
        }

        // Then remove the replies
        foreach ($discusReplies as $discusReply) {
            Reply::where('id', '=', $discusReply)->delete();
        }

        // Then remove the watchers
        foreach ($discusWatchers as $discusWatcher) {
            Watcher::where('id', '=', $discusWatcher)->delete();
        }

        // Remove the discussion by given ID
        Discussion::destroy($id);

        Session::flash('success', 'Discussion deleted');

        return redirect()->route('forum');
    }
}
