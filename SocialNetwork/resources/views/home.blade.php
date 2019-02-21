@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>        
    </ol>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Sidebar</div>
            </div>
            <div class="card-body">
                
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
