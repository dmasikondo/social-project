@extends('pages.template.app')
@section('content')
	@include('timeline.partials.profile_header',['uzer'=>Auth::user()])
	@auth
		<div class="timeline-nav">
			<ul class="nav nav-pills">
			 <li class="nav-item">
			 	<a href="#" class="nav-link">Timeline</a>
			 </li>
			 <li class="nav-item">
			 	<a href="#" class="nav-link">About</a>
			 </li>
			 <li class="nav-item">
			 	<a href="#" class="nav-link">Friends 
		 		@if(Auth::user()->numberOfFriends())
		 			<span class="namba">{{Auth::user()->numberOfFriends()}}</span>
		 		@endif				 		
			 	</a>
			 </li>
			 <li class="nav-item">
			 	<a href="#" class="nav-link">Photos</a>
			 </li>
			</ul>			
		</div>
		<div class="spacer"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<!-- bio -->
					@include('bio.intro')
					<!-- photos -->
					@include('bio.photos')
					<!-- friends -->

					<div class="card mt-4">
						@include('bio.friends')
					</div>
				</div>
				<!-- status form -->
				<div class="col-sm-8">
					@include('status.create')
					<div class="card mt-4">
						<div class="card-body">
@foreach($statuses as $status)
<div class="media">
	<img src="{{asset('storage/avatar/avatar'.$status->user->nameOfAvatarImage())}}" class="rounded-circle"> &nbsp;
	<div class="media-body">
		<h4 class="media-heading">
			<a href="/user/{{$status->user->email}}">{{$status->user->getFirstNameOrEmail()}}</a>
		</h4>
		<p><a href="/status/{{$status->id}}">{{$status->body}}</a></p>
		<ul class="list-inline">
			<li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
			<li class="list-inline-item">
				@if(!$status->alreadyLikedByUser())
					<a href="{{route('like-status',['statusToLike' =>$status->id])}}">Like</a>
				@else
					<a href="{{route('unlike-status',['statusToLike' =>$status->id])}}">
						<span class="fa fa-heart"></span>						
					</a>
					
				@endif
			</li>
			<li class="list-inline-item">{{$status->countLikes}} {{str_plural('like',$status->countLikes)}}						
				<i class="badge badge-default"> {{$status->replies->count()}} </i>
				<span class="fa fa-comment">					
				</span>
			</li>
		</ul>

	<!-- show replies -->
	@foreach($status->replies as $reply)
		<div class="media">
			<img src="{{asset('storage/avatar/avatar'.$reply->user->nameOfAvatarImage())}}" class="rounded-circle"> &nbsp;
			<div class="media-body">
				<h5 class="media-heading">
					<a href="/user/{{$reply->user->email}}">{{$reply->user->getFirstNameOrEmail()}}</a>
				</h5>
				<p>{{$reply->body}}</p>
				<ul class="list-inline">
					<li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
					<li class="list-inline-item">
						@if(!$reply->alreadyLikedByUser())
							<a href="{{route('like-status',['statusToLike' =>$reply->id])}}">Like</a>
						@else
						<a href="{{route('unlike-status',['statusToLike' =>$reply->id])}}">
							<span class="fa fa-heart"></span>						
						</a>
						@endif
					</li>

					<li class="list-inline-item">{{$reply->countLikes}} {{str_plural('like',$reply->countLikes)}}
					</li>
				</ul>
			</div>
		</div>
	@endforeach
		<!-- show reply form -->
	
		<form action="{{route('status-reply',['statusId' =>$status->id])}}" method="post">
			@csrf
			<div class="form-group">
				<textarea name="reply-{{$status->id}}" id="reply-{{$status->id}}" cols="30" rows="3" class="form-control {{$errors->has("reply-{$status->id}")? 'is-invalid': ''}}" placeholder="What's your reaction {{Auth::user()->getFirstNameOrEmail()}}?"></textarea>
				@if($errors->has("reply-{$status->id}"))
					<span class="invalid-feedback" role="alert">
						<strong>{{$errors->first("reply-{$status->id}")}}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<button class="btn btn-outline-success" type="submit">Reply</button>
			</div>
		</form>									
						</div>
					</div>
			@endforeach					
				</div>				
			</div>
		</div>
	@endauth	
@endsection