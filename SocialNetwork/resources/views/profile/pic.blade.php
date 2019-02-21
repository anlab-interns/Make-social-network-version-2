@extends('profile.master')

@section('content')
<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
            <li class="breadcrumb-item"><a href="{{url('/editProfile')}}">Edit Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Image</li>        
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
                    <div class="col-md-4">
                        Welcome to your profile
                        <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="100" height="100"></br>
                        <br>
                        <hr>

                        <form action="{{url('./')}}/uploadPhoto" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="file" name="pic" class="form-control">
                            <br>
                            <input type="submit" name="btn" class="btn btn-success" value="Change">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
