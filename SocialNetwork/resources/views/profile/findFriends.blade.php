@extends('profile.master')

@section('content')

<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Find Friends</li>        
        </ol>
    </nav>

    <div class="row justify-content-center">
        @include('profile.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            @foreach($allUsers as $uList)
                            <?php
                                $friended1=DB::table('friendships')
                                                ->where('user_requested','=',Auth::user()->id)
                                                ->where('requester','=',$uList->id)
                                                ->where('status','=',1)
                                                ->first();
                                $friended2=DB::table('friendships')
                                                ->where('user_requested','=',$uList->id)
                                                ->where('requester','=',Auth::user()->id)
                                                ->where('status','=',1)
                                                ->first();
                                if($friended1=='' && $friended2=='')
                                {
                                ?>
                                <div class="row border-bottom" style="padding: 10px">
                                    <div class="col-sm-12 col-md-2">
                                        <a href="">
                                            <img src="{{url('../')}}/public/img/{{$uList->pic}}" width="100" height="100" class="img-thumbnail">
                                        </a>
                                    </div>
                                    <div class="col-sm-12 col-md-6">    
                                        <h4><a href="{{url('/profile')}}/{{$uList->slug}}">{{$uList->name}}</a></h4>                        
                                        <h6 style="margin-bottom: 18px;color: gray"><i class='fas fa-globe-europe'></i> {{$uList->city}} - {{$uList->country}}</h6>
                                        <p>{{$uList->about}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-4"> 
                                        <?php
                                            $check1=DB::table('friendships')
                                                    ->where('user_requested','=',$uList->id)
                                                    ->where('requester','=',Auth::user()->id)
                                                    ->first();
                                            $check2=DB::table('friendships')
                                                    ->where('user_requested','=',Auth::user()->id)
                                                    ->where('requester','=',$uList->id)
                                                    ->first();
                                            if($check2!='')
                                            {
                                            ?>
                                                <p>
                                                    <a href="{{url('/accept')}}/{{$uList->name}}/{{$uList->id}}" class="btn btn-primary">Confirm</a>
                                                    <a href="{{url('/requestRemove')}}/{{$uList->id}}" class="btn btn-secondary">Cancel</a>
                                                </p>
                                            <?php
                                            }
                                            else
                                            {
                                                if($check1=='')
                                                {
                                                ?>
                                                    <p><a href="{{url('/')}}/addFriend/{{$uList->id}}" class="btn btn-primary">Add to Friend</a></p>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <p><a href="" class="btn btn-primary" disabled>Friend request sent <i class='fas fa-check'></i></a></p>
                                                <?php
                                                }
                                            }
                                        ?>
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
        </div>
    </div>
</div>
@endsection
