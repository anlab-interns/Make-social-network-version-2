@extends('profile.master')

@section('content')

<div class="container">
    <nav arial-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Requests</li>        
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
                    
                    @if ( session()->has('msg') )
                        <p class="alert alert-success">
                            {{ session()->get('msg') }}
                        </p>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            @foreach($notes as $note)
                            <div class="row border-bottom" style="padding: 10px">
                                <ul>
                                    <li>
                                        <p><a href="{{url('/profile')}}/{{$note->slug}}" style="font-weight: bold">{{$note->name}}</a> {{$note->note}}</p>
                                    </li>
                                </ul> 
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
