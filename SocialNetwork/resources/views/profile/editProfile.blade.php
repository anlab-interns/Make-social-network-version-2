@extends('profile.master')

@section('content')

<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>        
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
                                    <div class="card-header card-title" align="center">{{Auth::user()->name}}</div>
                                    <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="100" height="100" class="img-thumbnail card-img-top">
                                    <div class="card-body">
                                        <h4 class="card-title" align="center">{{$data->city}} - {{$data->country}}</h4>
                                        <p align="center">
                                            <a href="{{url('./')}}/changePhoto" class="btn btn-primary" role="button">Change Image</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-7">
                                <h4><span class="badge badge-secondary">Update your profile</span></h4>
                                <br>
                                <form action="{{url('/updateProfile')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">City</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="City Name" aria-label="City Name" aria-describedby="basic-addon1" name="city" value="{{$data->city}}">
                                    </div>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Country</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Country Name" aria-label="Country Name" aria-describedby="basic-addon1" name="country" value="{{$data->country}}">
                                    </div>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">About</span>
                                        </div>
                                        <textarea class="form-control" rows="10" aria-label="About" aria-describedby="basic-addon1" name="about"></textarea>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <input type="submit" class="btn btn-success" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
