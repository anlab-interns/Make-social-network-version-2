<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\like; 
use App\comment; 

class post extends Model
{
    protected $fillable=['user_id','content','status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function like()
    {
        return $this->hasMany('App\like');
    }   

    public function comment()
    {
        return $this->hasMany('App\comment');
    }   
}
