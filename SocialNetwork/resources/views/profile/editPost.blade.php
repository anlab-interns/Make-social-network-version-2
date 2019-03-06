@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>  
        <li class="breadcrumb-item active">Edit Post</li>        
    </ol>

    <div class="row justify-content-center">
         @include('profile.sidebar')

        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #e9ecef">Edit Post</div>

                <div class="card-body" style="background-color: rgba(0,0,0,.03);">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                    @foreach($posts as $post)
                        <form action="{{url('/getPostEdited')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="input-group mb-3">
                                <textarea class="form-control" rows="4" aria-describedby="basic-addon1" name="editedPost">{{$post->content}}</textarea>
                            </div>
                            <input type="hidden" name="postid" value="{{$post->pid}}">
                            <input type="submit" class="btn btn-primary" value="Edit Post">
                            <button class="btn btn-danger"><a href="{{ route('home')}}" style="text-decoration: none;color: white">Cancel</a></button>
                        </form>
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
