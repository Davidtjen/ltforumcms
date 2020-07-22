<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function userHasDiscussion($id)
    {
        $result = false;

        if ((User::find($id)->discussion->toArray())) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}
