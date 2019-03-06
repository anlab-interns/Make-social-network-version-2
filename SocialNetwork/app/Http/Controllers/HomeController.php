<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\users;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=DB::table('posts')
        ->leftJoin('profiles','profiles.user_id','posts.user_id')
        ->leftJoin('users','users.id','posts.user_id')
        ->orderBy('posts.created_at','desc')
        ->get();
        return view('home',compact('posts'));
    }
}
