<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\like; 

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
}
