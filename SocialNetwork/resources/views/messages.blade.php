@extends('profile.master')

@section('content')
	<div class="row">
		<div class="col-md-3 left-sidebar" style="background-color: #fff">
			<h3 align="center" style="padding: 10px;margin:0" class="row border-bottom">
				<div class="col-md-2"></div>
		        <div class="col-md-8">Messenger</div>
		        <div class="col-md-2 float-right">
		         	<a href="{{url('/newMessage')}}">
		            <img src="{{Config::get('app.url')}}/www/framework/SocialNetwork/public/img/compose.png" title="Send New Messages"></a>
		       	</div>
			</h3>
			<div style="margin-top: 10px">
			<ul v-for="privsteMsg in privsteMsgs" style="list-style: none;padding-left: 10px">
				<li @click="messages(privsteMsg.id)" v-on:click="seen = true" style="background-color: #F3F3F3" id="inboxSelect">
					<div class="row"> 
						<div class="col-md-3 float-left">
							<img :src="'{{Config::get('app.url')}}/www/framework/SocialNetwork/public/img/' + privsteMsg.pic" style="width:50px; border-radius:100%; margin:5px">
						</div>

						<div class="col-md-9 float-left" style="margin-top:5px">
	          				<b> @{{privsteMsg.name}}</b><br>
	          				<small>Gender: @{{privsteMsg.gender}}</small>
	       				</div>
       				</div>
				</li>
			</ul>
			</div>
		</div>

		<div class="col-md-6" style="background-color: #fff">
			<h3 align="center" style="padding: 10px;margin:0 0 10px 0" class="border-bottom">Messages</h3>
			<p class="alert alert-success">@{{msg}}</p>
			
			<div v-for="singleMsg in singleMsgs">
				<div v-if="singleMsg.user_from == <?php echo Auth::user()->id; ?>">
					<div class="col-md-12" style="margin-bottom: 10px;float: right;">
						<img :src="'{{Config::get('app.url')}}/www/framework/SocialNetwork/public/img/' + singleMsg.pic" style="width:25px; height: 25px; border-radius:100%; margin-left:5px;float: right">
						<div style="float: right;background-color: #0084ff;padding:5px 15px;margin-right: 10px;color: #fff;border-radius: 10px">
							@{{singleMsg.msg}}
						</div>
					</div>
				</div>
				<div v-else>
					<div class="col-md-12" style="margin-bottom: 10px;float: left;">
						<img :src="'{{Config::get('app.url')}}/www/framework/SocialNetwork/public/img/' + singleMsg.pic" style="width:25px; height: 25px; border-radius:100%; margin-left:5px;float: left">
						<div style="float: left;background-color:  #F0F0F0;padding:5px 15px;margin-left:5px;color: #333;border-radius: 10px;text-align: right">
							@{{singleMsg.msg}}
						</div>
					</div>
				</div>
			</div>
			<br>
			<div v-if="seen">
				<input type="hidden" v-model="conID">
				<textarea class="col-md-12 form-control" v-model="msgFrom" @keydown="inputHandler" id="msgInput" style="margin-top: 15px;">
				</textarea>
			</div>
		</div>
		

		<div class="col-md-3 left-sidebar" style="background-color: #fff">
			<h3 align="center" style="padding: 10px;margin:0" class="border-bottom">User infor</h3>
		</div>
	</div>
@endsection