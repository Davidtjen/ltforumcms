<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    public function index()
    {
        /*$discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);*/

        switch (request('filter')) {
            case 'me':
                $result = Discussion::where('user_id', Auth::id())->paginate(5);
                break;
            case 'solved':
                $answered = array();

                foreach (Discussion::all() as $d) {
                    if ($d->hasBestAnswer()) {
                        array_push($answered, $d);
                    }
                }

                $result = new Paginator($answered, 5);

                break;

            case'unsolved':
                $unanswered = array();

                foreach (Discussion::all() as $d) {
                    if (!$d->hasBestAnswer()) {
                        array_push($unanswered, $d);
                    }
                }

                $result = new Paginator($unanswered, 5);

                break;

            default:
                $result = Discussion::orderBy('created_at', 'desc')->paginate(5);
                break;
        }

        return view('forum', ['discussions' => $result]);
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();
        return view('channel')->with('discussions', $channel->discussions()->paginate(5));
    }

    public function search()
    {
        $search = request()->query('search');

        if ($search) {
            $result = Discussion::where('title', 'LIKE', '%' . $search . '%')->simplePaginate(5);
        } else {
            $result = Discussion::simplePaginate(5);
        }

        return view('search')->with('discussions', $result)->with('search', $search);
    }


}
