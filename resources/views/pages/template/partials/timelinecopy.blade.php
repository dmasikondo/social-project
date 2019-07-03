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
			<li class="list-inline-item">{{$status->countLikes}} {{str_plural('like',$status->countLikes)}}</li>
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

					<li class="list-inline-item">{{$reply->countLikes}} {{str_plural('like',$reply->countLikes)}}</li>
				</ul>
			</div>
		</div>
	@endforeach
	<!-- show reply form -->
	@if($conditionToRepyForm || Auth::user()->id == $status->user_id)
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
	@endif												
	</div>
</div>
