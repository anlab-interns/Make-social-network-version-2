<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
        ;
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <style>
        #inboxSelect :hover {
            cursor: pointer;
        }
    </style>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::check())
                            <li class="nav-item"><a class="nav-link" href="{{url('/findFriends')}}">Find Friends</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('/requests')}}">My Requests ({{App\friendships::where('status',0)->where('user_requested',Auth::user()->id)->count()}})</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{url('friends')}}"><i class="fas fa-2x fa-users"></i></a></li>

                            <li class="nav-item"><a class="nav-link" href="{{url('messages')}}"><img src="{{url('../')}}/public/img/messenger.png" width="30" height="30"></a></li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class='fas fa-2x fa-globe-asia'></i>
                                    <?php
                                        $notesCount=DB::table('notifcations')
                                                    ->where('status',1)
                                                    ->where('user_hero',Auth::user()->id)
                                                    ->count();
                                        if($notesCount>0)
                                        {
                                        ?>
                                            <span class="badge badge-dark" style="background-color: red;border-radius: 7.25rem;position: relative;top: -20px;right: 10px;">
                                                <?php
                                                    echo $notesCount;
                                                ?>
                                            </span>
                                        <?php
                                        }
                                    ?>
                                    
                                </a>

                                <?php
                                    $notes=DB::table('users')
                                            ->rightJoin('notifcations','users.id','notifcations.user_logged')
                                            ->where('user_hero',Auth::user()->id)
                                            //->where('status',1)
                                            ->orderBy('notifcations.created_at','desc')
                                            ->get();
                                ?>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach($notes as $note)
                                    @if($note->status==1)
                                    <a class="dropdown-item" href="{{url('/notifications')}}/{{$note->id}}" style="background-color: #E4E9F2">
                                        <b style="color: #3490dc">{{$note->name}}</b> {{$note->note}}
                                    </a>
                                    @else
                                    <a class="dropdown-item" href="{{url('/notifications')}}/{{$note->id}}">
                                        <b style="color: #3490dc">{{$note->name}}</b> {{$note->note}}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="30" height="30"> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{url('/profile')}}/{{ Auth::user()->slug}}" >
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('home') }}" >
                                        {{ __('Home') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ url('editProfile') }}">
                                        {{ __('Edit profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
