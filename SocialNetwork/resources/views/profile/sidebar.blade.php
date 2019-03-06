<div class="col-md-3">
    <div class="card">
        <div class="card-header" style="background-color: #e9ecef">Quick links</div>
        <div class="card-body" style="background-color: rgba(0,0,0,.03);">
            <div class="row border-bottom" style="padding: 0 10px 10px 10px">
                <div class="col-md-4">
                    <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="30" height="30" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <a href="{{url('/profile')}}/{{Auth::user()->slug}}" style="color: gray">Profile</a>
                </div>
            </div>  
            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <img src="{{url('../')}}/public/img/newfeed.png" width="30" height="30">
                </div>
                <div class="col-md-8">
                    <a href="{{ Route('home') }}" style="color: gray">New Feed</a>
                </div>
            </div> 

            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <img src="{{url('../')}}/public/img/messenger.png" width="30" height="30">
                </div>
                <div class="col-md-8">
                    <a href="{{url('/messages')}}" style="color: gray">Messenger</a>
                </div>
            </div>

            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <i class="fas fa-2x fa-users"></i>
                </div>
                <div class="col-md-8">
                    <a href="{{url('/friends')}}" style="color: gray">List Friend</a>
                </div>
            </div>  

            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <i class="fas fa-2x fa-edit"></i>
                </div>
                <div class="col-md-8">
                    <a href="{{url('/editProfile')}}" style="color: gray">Edit Profile</a>
                </div>
            </div>

            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <i class="fas fa-2x fa-handshake"></i>
                </div>
                <div class="col-md-8">
                    <a href="{{url('/requests')}}" style="color: gray">My Request</a>
                </div>
            </div>

            <div class="row border-bottom" style="padding:10px">
                <div class="col-md-4">
                    <i class="fas fa-2x fa-user-friends"></i>
                </div>
                <div class="col-md-8">
                    <a href="{{url('/findFriends')}}" style="color: gray">Find Friends</a>
                </div>
            </div> 

        </div>
    </div>
</div>
