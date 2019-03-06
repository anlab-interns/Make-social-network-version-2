<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\user;
use App\post;

class PostsController extends Controller
{
    // public function createPost(Request $request)
    // {
    // 	$uid=Auth::user()->id;
    // 	$post = new Post();
    // 	$post->user_id=$uid;
    // 	$post->content=$request['stt'];
    // 	$post->status='1';
    // 	$post->save();
    // 	return redirect()->route('home');
    // }
    public function addPost(Request $request)
    {
        echo $content=$request->content;
        $createPost=DB::table('posts')
        ->insert(['content' => $content, 'user_id' => Auth::user()->id, 'status' => 0,'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        if($createPost)
        {
            $posts_json=DB::table('posts')
            ->leftJoin('profiles','profiles.user_id','posts.user_id')
            ->leftJoin('users','users.id','posts.user_id')
            ->orderBy('posts.created_at','desc')->take(2)
            ->get();
            return $posts_json;
        }
    }
}
