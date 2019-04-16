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
							<div class="media">
								<span class="fa fa-user mr-2 mt-3"></span>
								<div class="media-body">
									<h5 class="media-heading">
										<a href="#">Another</a>
									</h5>
									<p>This is my response to your status</p>
									<ul class="list-inline">
										<li class="list-inline-item">9 minutes ago</li>
										<li class="list-inline-item"><a href="#">Like</a></li>
										<li class="list-inline-item">3 likes</li>
									</ul>
								</div>
							</div>
							<form action="#" method="">
								@csrf
								<div class="form-group">
									<textarea name="reply" id="reply" cols="30" rows="3" class="form-control {{$errors->has('reply')? 'is-invalid': ''}}" placeholder="What's your reaction {{Auth::user()->getFirstNameOrEmail()}}?"></textarea>
									@if($errors->has('reply'))
										<span class="invalid-feedback" role="alert">
											<strong>{{$errors->first('reply')}}</strong>
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