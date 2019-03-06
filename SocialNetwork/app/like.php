<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $fillable=['user_id','post_id','like'];
    public function post()
    {
        return $this->belongsTo('App\post');
    }
}
