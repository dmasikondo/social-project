@extends('pages.template.app')
@section('content')
	<div class="spacer"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h4>Your friends {{$friends->count()}}</h4>
				@if(!$friends->count())
					You do not have any friends
				@else
					@foreach($friends as $user)
						@include('pages.template.partials.userblock')
					@endforeach
				@endif
			</div>
			<div class="col-lg-6">
				<h4>Friend requests</h4>
				@if(!$friendRequests->count())
					You have no friend requests
				@else				
					@foreach($friendRequests as $user)
						<div class="card mb-1">
							<div class="row">
								<div class="col-md-1 pl-2">
									<img src="{{asset('storage/avatar/avatar'.$user->nameOfAvatarImage())}}" class="rounded-circle">
								</div>
								<div class="col-md-11">
									<div class="card-body">
										<p class="card-text pull-right">
											@include('friends.friendship_status')
										</p>										
										<h6 class="card-title">
											<a href="/user/{{$user->email}}">{{$user->getFirstNameOrEmail()}}</a>
										</h6>										
										<p class="card-text">
											<small class="text-muted">
												{{$user->location}}
											</small>
										</p>
									</div>
								</div>
							</div>
						</div>						
					 {{--@include('pages.template.partials.userblock')--}}
					@endforeach					
				</div>

				@endif				
			</div>
		</div>
	</div>
@endsection