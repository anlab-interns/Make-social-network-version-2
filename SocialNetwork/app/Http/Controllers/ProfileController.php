<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\users;

class ProfileController extends Controller
{
    public function index($slug)
    {
        $userData=DB::table('users')
                ->where('slug',$slug)
                ->leftJoin('profiles','profiles.user_id','users.id')
                ->get();

    	return view('profile.index',compact('userData'))->with('data',Auth::user()->profile);
    }

    public function uploadPhoto(Request $request)
    {
    	$file = $request->file('pic');
    	$filename = $file->getClientOriginalName();

    	$path='img';

    	$file->move($path,$filename);
    	$user_id=Auth::user()->id;

    	DB::table('users')->where('id',$user_id)->update(['pic'=>$filename]);
    	//return view('profile.index');
    	return back();
    }

    public function editProfileForm()
    {
    	return view('profile.editProfile')->with('data',Auth::user()->profile);
    }

    public function updateProfile(Request $request)
    {
    	$user_id=Auth::user()->id;
    	DB::table('profiles')->where('user_id',$user_id)->update($request->except('_token'));
    	return back();
    }

    public function findFriends()
    {
        $uid=Auth::user()->id;
        $allUsers=DB::table('profiles')->leftJoin('users','users.id','=','profiles.user_id')->where('users.id','!=',$uid)->get();

        return view('profile.findFriends',compact('allUsers'));
    }

    public function sendRequest($id)
    {
        Auth::user()->addFriend($id);
        return back();
    }

    public function requests()
    {
        $uid=Auth::user()->id;
        $FriendRequests=DB::table('friendships')
                        ->rightJoin('users','users.id','=','friendships.requester')
                        ->where('status',0)
                        ->where('friendships.user_requested','=',$uid)->get();

        return view('profile.requests',compact('FriendRequests'));
    }

    public function accept($name,$id)
    {
        $uid=Auth::user()->id;
        $checkRequest=friendships::where('requester',$id)
                    ->where('user_requested',$uid)
                    ->first();
        if($checkRequest)
        {
            $updateFriendship=DB::table('friendships')
                            ->where('user_requested',$uid)
                            ->where('requester',$id)
                            ->update(['status' => 1]);

            $notifcations=new notifcations;
            //who accept the request
            $notifcations->user_hero=$id;
            //who received note
            $notifcations->user_logged=$uid;
            //status unread
            $notifcations->status='1';
            $notifcations->note='accepted your friend request';
            $notifcations->save();

            if($notifcations)
            {
                return back()->with('msg','You are now Friend with '.$name);
            }
        }
        else
        {
            return back()->with('msg','You are not Friend with '.$name);
        }
    }

    public function friends()
    {
        $uid=Auth::user()->id;

        $friends1=DB::table('friendships')
                ->leftJoin('users','users.id','friendships.user_requested')
                ->where('status',1)
                ->where('requester',$uid)
                ->get();

        $friends2=DB::table('friendships')
                ->leftJoin('users','users.id','friendships.requester')
                ->where('status',1)
                ->where('user_requested',$uid)
                ->get();

        $friends = array_merge($friends1->toArray(),$friends2->toArray());
        return view('profile.friends',compact('friends'));
    }

    public function requestRemove($id)
    {
        $uid=Auth::user()->id;

        DB::table('friendships')
        ->where('user_requested',$uid)
        ->where('requester',$id)
        ->delete();

        return back()->with('msg','Request has been deleted');
    }

    public function notifications($id)
    {
        $notes=DB::table('users')
            ->rightJoin('notifcations','users.id','notifcations.user_logged')
            ->where('notifcations.id',$id)
            ->where('user_hero',Auth::user()->id)
            ->orderBy('notifcations.created_at','desc')
            ->get();

        $updateNoti=DB::table('notifcations')
                    ->where('id',$id)
                    ->update(['status' => 0]);
                    
        return view('profile.notifcations',compact('notes'));
    }

    public function sendMessage(Request $request)
    {
        $msg=$request->msg;
        $conID=$request->conID;
        $fetch_userTo=DB::table('messages')
                    ->where('conversation_id',$conID)
                    ->where('user_to','!=',Auth::user()->id)
                    ->get();
        $userTo=$fetch_userTo[0]->user_to;
        $sendM=DB::table('messages')->insert([
            'user_to'=>$userTo,
            'user_from'=>Auth::user()->id,
            'msg'=>$msg,
            'status'=>1,
            'conversation_id'=>$conID
        ]);
        if($sendM){ 
            $userMsg=DB::table('messages')
            ->join('users','users.id','messages.user_from')
            ->where('messages.conversation_id',$conID)->get();
            return $userMsg;
        }
    }

    public function newMessage(){
    $uid = Auth::user()->id;
    $friends1 = DB::table('friendships')
            ->leftJoin('users', 'users.id', 'friendships.user_requested') 
            ->where('status', 1)
            ->where('requester', $uid)
            ->get();
    $friends2 = DB::table('friendships')
            ->leftJoin('users', 'users.id', 'friendships.requester')
            ->where('status', 1)
            ->where('user_requested', $uid)
             ->get();
    $friends = array_merge($friends1->toArray(), $friends2->toArray());
    return view('newMessage', compact('friends', $friends));
    }

    public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;
        //check if conversation already started or not
        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
        ->where('user_two',$friend_id)->get(); 
        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
        ->where('user_one',$friend_id)->get(); 
        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());
        // old conversation
        if(count($allCons)!=0){
            $conID_old = $allCons[0]->id;
            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_old,
                'status' => 1
            ]);
        // new conversation
        }else {     
            $conID_new = DB::table('conversation')->insertGetId([
            'user_one' => $myID,
            'user_two' => $friend_id
            ]);
            echo $conID_new;
            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_new,
                'status' => 1
            ]);
        }
    }
}
