@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>        
    </ol>

    <div class="row justify-content-center">
        @include('profile.sidebar')

        <div class="col-md-6">
            <div class="card" style="margin-bottom: 10px">
                <div class="card-header" style="background-color: #e9ecef"><b>Create a post</b></div>

                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="60" height="60" class="img-thumbnail">
                        </div>
                        <div class="col-md-10 col-sm-9">
                            <form action="{{url('/createPost')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="4" placeholder="What 's on your mind?" aria-describedby="basic-addon1" name="stt"></textarea>
                                </div>
                                <input type="file" name="photo" class="form-control float-right">
                                <input type="submit" class="btn btn-primary float-right" value="Post" style="margin-top: 10px;width: 15%">
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
                            <div class="row border rounded post" style="background-color:#fff;margin-bottom:10px;padding:10px">
                                <div class="col-md-2">
                                    <img src="{{url('../')}}/public/img/{{$post->pic}}" width="60" class="img-thumbnail" style="margin: 5px">
                                </div>

                                <div class="col-md-8">
                                    <p style="margin-bottom: 0px;font-size: 20px"><a href="{{url('/profile')}}/{{$post->slug}}"><b>{{$post->name}}</b></a></p>
                                    <p style="font-size: 12px"><i class='fas fa-globe-europe'></i> {{$post->country}}</p>
                                </div>
                                @if(Auth::user()->id==$post->user_id)
                                <div class="col-md-1">
                                    <a href="{{url('/editPost')}}/{{$post->pid}}"><i class="far fa-edit"></i></a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{url('/deletePost')}}/{{$post->pid}}"><i class="far fa-trash-alt"></i></a>
                                </div>
                                @endif
                                <p class="col-md-12" style="color: #333;margin-top:10px;font-size: 18px;text-align: justify;">{{$post->content}}</p>
                                @if($post->photo!="")
                                    <img src="{{url('../')}}/public/upload/{{$post->photo}}" class="img-thumbnail" style="margin: 5px;width: 100%;height: 100%">
                                @endif
                                <div class="col-md-12">
                                    <div class="col-md-2" style="display: inline-block;padding: 0">
                                    <?php
                                        $countLike=DB::table('likes')
                                                ->where('post_id',$post->pid)
                                                ->where('like','1')
                                                ->count();
                                        if($countLike>0)
                                        {
                                            echo '<i class="far fa-thumbs-up"></i> '.$countLike;
                                        }
                                    ?>
                                    </div>

                                    <div class="col-md-3" style="display: inline-block;padding:0">
                                    <?php
                                        $countComment=DB::table('comments')
                                                ->where('post_id',$post->pid)
                                                ->count();
                                        if($countComment>0)
                                        {
                                            echo '<i class="far fa-comment"></i> '.$countComment;
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="col-md-12 border-top border-bottom">
                                    <div class="col-md-6" style="color:#333;padding:10px 0 5px 0;margin-bottom:0;display: inline-block;text-align: center">
                                        <?php
                                            $checkLike=DB::table('likes')
                                                    ->where('user_id',Auth::user()->id)
                                                    ->where('post_id',$post->pid)
                                                    ->where('like','1')
                                                    ->get();
                                            if($checkLike=="[]")
                                            {
                                                ?>
                                                    <a href="{{url('/likePost')}}/{{$post->pid}}" style="text-decoration: none"> <i class="far fa-thumbs-up"></i> Like</a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <a href="{{url('/likePost')}}/{{$post->pid}}" style="text-decoration: none;font-weight: bold"> <i class="fas fa-thumbs-up"></i> Liked</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    
                                    <div class="col-md-5" style="color: #333;padding:10px 0 5px 0;margin-bottom:0;display: inline-block;text-align: center">    
                                        <a href="" style="text-decoration:none" data-toggle="collapse" data-target="#cmt<?php echo $post->pid; ?>"><i class="far fa-comment"></i> Comment
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding: 0">
                                    <div id="cmt<?php echo $post->pid; ?>" class="collapse" style="margin-top: 5px;padding: 5px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                    $getCmts=DB::table('comments')
                                                    ->leftJoin('profiles','profiles.user_id','comments.user_id')
                                                    ->leftJoin('users','users.id','comments.user_id')
                                                    ->where('comments.post_id',$post->pid)
                                                    ->get();
                                                ?>
                                                
                                                @foreach($getCmts as $getCmt)
                                                <div class="row border" style="padding: 5px;margin: 5px;border-radius: 10px;background-color: #F3F3F3">
                                                    <div class="col-md-1" style="padding-right: 0px">
                                                        <img src="{{url('../')}}/public/img/{{$getCmt->pic}}" width="30" height="30" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-md-3" style="padding-right:0;padding-left: 3px">
                                                        <a href="{{url('/profile')}}/{{$getCmt->slug}}" style="font-weight: bold;text-decoration: none">{{$getCmt->name}}</a>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:7px">
                                                        <p style="margin-bottom: 0;text-align: justify;">{{$getCmt->comment}}</p>
                                                    </div>    
                                                </div>
                                                @endforeach     
                                            </div>
                                        </div>
                                        <form action="{{url('/commentPost')}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row" style="margin-top: 5px">  
                                                <div class="col-md-2" style="padding: 0 0 0 30px">
                                                    <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="35" height="35" class="img-thumbnail">
                                                </div>              
                                                <div class="col-md-8" style="padding-left: 0">
                                                    <textarea style="width: 100%;border-radius: 5px;height: 37px" name="reply" placeholder=" Write comment"></textarea>
                                                </div>
                                                <input type="hidden" name="postid" value="{{$post->pid}}">
                                                <div class="col-md-2" style="padding-left: 0">
                                                    <input type="submit" name="btnreply" value="Reply" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                <div class="card-header" style="background-color: #e9ecef"><b>Friends</b></div>
                <div class="card-body" style="background-color: rgba(0,0,0,.03); padding-top: 0">
                    @if(Auth::check())
                        @foreach(App\user::with('friends')->get() as $user)
                            @if($user->isOnline())
                                @if($user->id != Auth::user()->id)
                                    <div class="row border-bottom" style="padding: 10px 10px 10px 10px">
                                        <div class="col-md-2">
                                            <i class="fa fa-circle" style="color: #52ad52"></i>
                                        </div>
                                        <div class="col-md-8">
                                            <a href="{{url('/profile')}}/{{$user->slug}}" style="color:gray; text-decoration: none;">{{$user->name}}</a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row border-bottom" style="padding: 10px 10px 10px 10px">
                                    <div class="col-md-2">
                                        <i class="fa fa-circle" style="color: #ccc"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="{{url('/profile')}}/{{$user->slug}}" style="color: gray; text-decoration: none">{{$user->name}}</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
