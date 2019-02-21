@extends('profile.master')

@section('content')
<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Profile</li>        
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
                        <div class="col-sm-6 col-md-5">
                            <div class="card">
                                <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="100" height="100" class="img-thumbnail card-img-top">
                                <div class="card-body">
                                    <h4 class="card-title" align="center">{{$data->city}} - {{$data->country}}</h4>
                                    <p align="center">
                                        <a href="{{url('/editProfile')}}" class="btn btn-primary" role="button">Edit profile</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <h4><span class="badge badge-secondary">About</span></h4>
                            <br>
                            <p>{{$data->about}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
