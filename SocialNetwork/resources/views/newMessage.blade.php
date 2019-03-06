@extends('profile.master')

@section('content')
	<div class="row">
		<div class="col-md-3 left-sidebar" style="background-color: #fff">
			<h3 class="row border-bottom" style="padding:10px">
       			<div class="col-md-7">Friend List</div>
       			<div class="col-md-5 float-right">
         			<a href="{{url('/messages')}}" class="btn btn-sm btn-primary">All messages</a>
       			</div>
       		</h3>
			<div style="margin-top: 10px">	
				@foreach($friends as $friend)
			   	<li @click="friendID({{$friend->id}})" v-on:click="seen = true" style="list-style: none;" id="inboxSelect">
			   		<div class="row" style="margin: 10px;background-color: #F3F3F3">
			      	<div class="col-md-3 float-left">
			        	<img src="{{Config::get('app.url')}}/www/framework/SocialNetwork/public/img/{{$friend->pic}}" style="width:50px;border-radius:100%; margin:5px">
			       	</div>

			     	<div class="col-md-9 float-left" style="margin-top:5px">
			        	<b> {{$friend->name}}</b><br>
			        	<small>Gender: {{$friend->gender}}</small>
			     	</div>
			     	</div>
			   	</li>
			   	@endforeach
			</div>
		</div>

		<div class="col-md-6" style="background-color: #fff">
			<h3 align="center" style="padding: 10px;margin:0 0 10px 0" class="border-bottom">Messages</h3>
			<p class="alert alert-success">@{{msg}}</p>
    		<div v-if="seen">
		      	<input type="hidden" v-model="friend_id">
		      	<textarea class="col-md-12 form-control" v-model="newMsgFrom"></textarea><br>
		      	<input type="button" class="btn btn-primary" value="Send message" @click="sendNewMsg()">
	    	</div>
		</div>

		<div class="col-md-3 left-sidebar" style="background-color: #fff">
			<h3 align="center" style="padding: 10px;margin:0" class="border-bottom">User infor</h3>
		</div>
	</div>
@endsection