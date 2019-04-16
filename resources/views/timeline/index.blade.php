@auth
	<div class="row">
		<div class="col-lg-6">
			<form action="/status" method="post">
				@csrf
				<div class="form-group">
					<textarea name="timeline" id="status" cols="30" rows="3" class="form-control {{$errors->has('timeline')? 'is-invalid': ''}}" placeholder="What's up {{Auth::user()->getFirstNameOrEmail()}}?"></textarea>
					@if($errors->has('timeline'))
						<span class="invalid-feedback" role="alert">
							<strong>{{$errors->first('timeline')}}</strong>
						</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-outline-success" type="submit">Update</button>
				</div>
			</form>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			@if(!$statuses->count())
				<p>You have nothing in your timeline yet</p>
			@else
				@foreach($statuses as $status)
					<div class="media">
						<span class="fa fa-user mr-2 mt-3"></span>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="/user/{{$status->user->email}}">{{$status->user->getFirstNameOrEmail()}}</a>
							</h4>
							<p>{{$status->body}}</p>
							<ul class="list-inline">
								<li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
								<li class="list-inline-item"><a href="#">Like</a></li>
								<li class="list-inline-item">10 likes</li>
							</ul>
						<!-- show replies -->
						@foreach($status->replies as $reply)
							<div class="media">
								<span class="fa fa-user mr-2 mt-3"></span>
								<div class="media-body">
									<h5 class="media-heading">
										<a href="/user/{{$reply->user->email}}">{{$reply->user->getFirstNameOrEmail()}}</a>
									</h5>
									<p>{{$reply->body}}</p>
									<ul class="list-inline">
										<li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
										<li class="list-inline-item"><a href="#">Like</a></li>
										<li class="list-inline-item">3 likes</li>
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
				{!! $statuses->render() !!}
			@endif
		</div>
	</div>
@endauth