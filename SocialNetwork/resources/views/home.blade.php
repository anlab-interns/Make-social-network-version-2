@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>        
    </ol>

    <div class="row justify-content-center">
        @include('profile.sidebar')

        <div class="col-md-6">
            <div class="card" style="margin-bottom: 10px">
                <div class="card-header" style="background-color: #e9ecef">Create a post</div>

                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="60" height="60" class="img-thumbnail">
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
                            <div class="row border rounded post" style="background-color:#fff;margin-bottom:10px;padding:10px">
                                <div class="col-md-2">
                                    <img src="{{url('../')}}/public/img/{{$post->pic}}" width="60" class="img-thumbnail" style="margin: 5px">
                                </div>

                                <div class="col-md-8">
                                    <p style="margin-bottom: 0px;font-size: 20px"><a href="{{url('/profile')}}/{{$post->slug}}"><b>{{$post->name}}</b></a></p>
                                    <p style="font-size: 12px"><i class='fas fa-globe-europe'></i> {{$post->created_at}}</p>
                                </div>
                                @if(Auth::user()->id==$post->user_id)
                                <div class="col-md-1 interaction">
                                    <a href="{{url('/editPost')}}/{{$post->pid}}"><i class="far fa-edit"></i></a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{url('/deletePost')}}/{{$post->pid}}"><i class="far fa-trash-alt"></i></a>
                                </div>
                                @endif
                                <p class="col-md-12" style="color: #333;margin-top:10px;font-size: 18px">{{$post->content}}</p>

                                <div class="col-md-12">
                                <?php
                                    $countLike=DB::table('likes')
                                            ->where('post_id',$post->pid)
                                            ->where('like','1')
                                            ->count();
                                    if($countLike>0)
                                    {
                                        echo '<i class="far fa-thumbs-up"></i>';
                                        echo  $countLike;
                                    }
                                ?>
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
                                        <a href="" style="text-decoration: none"><i class="far fa-comment"></i> Comment</a>
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
                <div class="card-header" style="background-color: #e9ecef">Adv.</div>
            </div>
        </div>
    </div>
</div>

@endsection
