<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find user before remove avatar and then profile
        $user = User::find($id);

        // remove avatar in public storage : public/ before removing profile
        if ($user->profile->avatar != '/avatars/avatarAdmin.png'
            && $user->profile->avatar != '/avatars/avatarDefault.png'
            && $user->profile->avatar != '/avatars/avatarEmily.png'
        ) {
            unlink(public_path() . $user->profile->avatar);
        }

        // remove profile before removing user
        $profile = Profile::where('user_id', $id);
        $profile->delete();

        // Remove the user by given ID
        User::destroy($id);

        Session::flash('success', 'User deleted');

        return redirect()->back();
    }

    public function userDiscussions($id)
    {
        $discussionsForThisUser = Discussion::where('user_id', '=', $id)->pluck('title')->toArray();

        return view('users.discussions')->with('discussionsForThisUser', $discussionsForThisUser);
    }

    public function searchUser()
    {
        $searchedUser = request()->query('searchuser');

        if ($searchedUser) {
            $result = User::where('name', 'LIKE', '%' . $searchedUser . '%')->simplePaginate(5);
        } else {
            $result = User::simplePaginate(5);
        }

        return view('users.searcheduser')->with('users', $result)->with('searchedUser', $searchedUser);
    }

}
