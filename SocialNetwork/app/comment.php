<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable=['comment','user_id','post_id'];
    public function post()
    {
        return $this->belongsTo('App\post');
    }
}
