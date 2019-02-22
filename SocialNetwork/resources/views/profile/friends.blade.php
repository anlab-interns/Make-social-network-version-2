@extends('profile.master')

@section('content')

<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Friends</li>        
        </ol>
    </nav>

    <div class="row justify-content-center">
        @include('profile.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Your Friends</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if ( session()->has('msg') )
                        <p class="alert alert-success">
                            {{ session()->get('msg') }}
                        </p>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            @foreach($friends as $uList)
                            <div class="row border-bottom" style="padding: 10px">
                                <div class="col-sm-12 col-md-2">
                                    <a href="">
                                        <img src="{{url('../')}}/public/img/{{$uList->pic}}" width="100" height="100" class="img-thumbnail">
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">    
                                    <h4><a href="">{{$uList->name}}</a></h4>   
                                    <br>                                    
                                    <h6 style="color:#6c757d"><b>Gender: </b>{{$uList->gender}}</h6>
                                    <h6 style="color:#6c757d"><b>Email: </b>{{$uList->email}}</h6>
                                </div>
                                <div class="col-sm-12 col-md-4"> 
                                    <p>
                                        <a href="{{url('/unfriend')}}/{{$uList->id}}" class="btn btn-secondary">UnFriend</a>
                                    </p>
                                </div>    
                            </div>
                            @endforeach
                        </div>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
