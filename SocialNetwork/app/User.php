<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\profile;
use App\post;
use Auth;
use DB;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'pic','password','slug','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\profile');
    }

    public function post()
    {
        return $this->hasMany('App\post');
    }    

    public function isOnline()
    {
        return Cache::has('active-user' . $this->id);
    }

    public function friends()
    {
        return $this->belongsTo('App\friendships','id','requester');
    }
}
