<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\User;
use App\post;
use App\like;

class PostsController extends Controller
{
    public function createPost(Request $request)
    {
    	$uid=Auth::user()->id;
    	$post = new Post();
    	$post->user_id=$uid;
    	$post->content=$request['stt'];
    	$post->status='1';
    	$post->save();
    	return redirect()->route('home');
    }

    public function deletePost($post_id)
    {
        DB::table('posts')
            ->where('pid',$post_id)
            ->delete();
        return redirect()->route('home');
    }

    public function likePost($post_id)
    {
        $uid=Auth::user()->id;
        $liked=DB::table('likes')
            ->where('user_id',$uid)
            ->where('post_id',$post_id)
            ->where('like','1')
            ->get();
        if($liked=="[]")   
        { 
            DB::table('likes')->insert([
                    'user_id' => $uid,
                    'post_id' => $post_id,
                    'like' => 1
                ]);
        }
        else
        {
            DB::table('likes')
            ->where('user_id',$uid)
            ->where('post_id',$post_id)
            ->update(['like'=>0]);
        }
        return redirect()->route('home');  
    }

    public function editPost($post_id)
    {
        $uid=Auth::user()->id;
        $posts=DB::table('posts')
            ->where('user_id',$uid)
            ->where('pid',$post_id)
            ->get();
        return view('profile.editPost',compact('posts'));
    }
 
    public function getPostEdited(Request $request)
    {
        $newContent=$request['editedPost'];
        $pid=$request['postid'];
        DB::table('posts')
            ->where('pid',$pid)
            ->update(['content'=>$newContent]);
        echo $newContent;
        return redirect()->route('home');
    }  
}
