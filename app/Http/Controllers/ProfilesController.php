<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $profile = Profile::where('user_id', $id)->first();

        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);

        return view('profiles.edit')->with('profile', $profile);
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
        // Validate request input
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // store users in variables to do check if they are the same user
        $userFromId = User::find($id);
        $user = Auth::user();

        // check if both are from the same user
        if ($userFromId->id == $user->id) {

            // remove old avatar in public storage : public/
            if ($user->profile->avatar != '/avatars/avatarAdmin.png'
                && $user->profile->avatar != '/avatars/avatarDefault.png'
                && $user->profile->avatar != '/avatars/avatarEmily.png'
            ) {
                unlink(public_path() . $user->profile->avatar);
            }

            if ($request->hasFile('avatar')) {

                $avatar = $request->avatar;

                $avatar_new_name = time() . $avatar->getClientOriginalName();

                $avatar->move('avatars', $avatar_new_name);

                $user->profile->avatar = '/avatars/' . $avatar_new_name;

                $user->profile->update();
            }
        } else {
            Session::flash('success', 'Please update YOUR OWN avatar. Fucker!!');
            return redirect(route('forum'));
        }

        Session::flash('success', 'Avatar successfully updated');

        return redirect(route('profiles.show', ['user_id' => $user->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
