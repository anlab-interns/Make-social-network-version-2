@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>        
    </ol>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header" style="background-color: #e9ecef">Left Sidebar</div>
                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    <ol style="list-style: none;padding: 0">
                        <li class="border-bottom">
                            <a href="{{url('/profile')}}/{{Auth::user()->slug}}" style="color: gray">Profile</a>
                        </li>
                        <li class="border-bottom">
                            <a href="{{url('/editProfile')}}" style="color: gray">Edit Profile</a>
                        </li>
                        <li class="border-bottom">
                            <a href="{{url('/requests')}}" style="color: gray">My Request</a>
                        </li>
                        <li class="border-bottom">
                            <a href="{{url('/findFriends')}}" style="color: gray">Find Friends</a>
                        </li>
                        <li class="border-bottom">
                            <a href="{{url('/friends')}}" style="color: gray">List Friend</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="margin-bottom: 10px">
                <div class="card-header" style="background-color: #e9ecef">Create a post</div>

                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="60" height="60" >
                    </div>
                    <div class="col-md-10 col-sm-9">
                    <form action="{{url('/createPost')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="input-group mb-3">
                            <textarea class="form-control" rows="4" placeholder="What are you thinking?" aria-describedby="basic-addon1" name="stt"></textarea>
                        </div>
                        
                        <input type="submit" class="btn btn-primary btn float-right" value="Post">
                    </form>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background-color: #e9ecef">Dashboard</div>

                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                    @foreach($posts as $post)
                        <?php
                            $user_post=$post->user_id;
                            $friend1=DB::table('friendships')
                                    ->where('status',1)
                                    ->where('requester',Auth::user()->id)
                                    ->where('user_requested',$user_post)
                                    ->get();
                            $friend2=DB::table('friendships')
                                    ->where('status',1)
                                    ->where('user_requested',Auth::user()->id)
                                    ->where('requester',$user_post)
                                    ->get();
                            if($friend1 != '[]' || $friend2 != '[]' || $user_post==Auth::user()->id)
                            {
                            ?>
                            <div class="row border rounded" style="background-color:#fff;margin-bottom:10px;padding:10px">
                                <div class="col-md-2">
                                    <img src="{{url('../')}}/public/img/{{$post->pic}}" width="60" class="img-thumbnail" style="margin: 5px">
                                </div>

                                <div class="col-md-10">
                                    <p style="margin-bottom: 0px;font-size: 20px"><a href="{{url('/profile')}}/{{$post->slug}}"><b>{{$post->name}}</b></a></p>
                                    <p style="font-size: 12px"><i class='fas fa-globe-europe'></i> {{$post->created_at}}</p>
                                </div>

                                <p class="col-md-12" style="color: #333;margin-top:10px;">{{$post->content}}</p>
                                <p class="col-md-4 border-top" style="color:#333;padding-top:10px;margin-bottom:0">
                                   <a href=""> <i class="far fa-thumbs-up"></i> Like</a>
                                </p>
                                <p class="col-md-4 border-top" style="color: #333;padding-top:10px;margin-bottom:0">    
                                    <a href=""><i class="far fa-comment"></i> Comment</a>
                                </p>
                                <p class="col-md-4 border-top" style="color: #333;padding-top:10px;margin-bottom:0">
                                    <a href=""><i class="far fa-share-square"></i> Share</a>
                                </p>
                            </div>
                            <?php
                            }
                        ?>
                     @endforeach
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Right Sidebar</div>
            </div>
        </div>
    </div>
</div>
@endsection
