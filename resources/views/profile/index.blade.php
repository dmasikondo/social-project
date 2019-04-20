@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<h2>{{$user->getFirstNameOrEmail()}}'s Timeline</h2>
				<hr>
				@if(!$statuses->count())				
					<p>There is nothing on {{$user->getFirstNameOrEmail()}}'s timeline yet</p>				
				@else
					@foreach($statuses as $status)				
						@include('pages.template.partials.timeline',['conditionToRepyForm' => Auth::user()->isFriendsWith($status->user)])
				@endforeach
				{!! $statuses->render() !!}
			@endif						
			</div>
			<div class="col-lg-4 offset-lg-3">
				@if(Auth::user()->hasFriendRequestPending($user))
					<p>Waiting for {{$user->getFirstNameOrEmail()}} to accept your friend request</p>
				@elseif(Auth::user()->hasFriendRequestReceived($user))
					<p><a href="{{route('accept-friend', [$user->email])}}" class="btn btn-primary">Accept Friend Request</a></p>
				@elseif(Auth::user()->isFriendsWith($user))
					<p>You are friends with {{$user->getFirstNameOrEmail()}}
					</p>
					<form action="{{route('remove-friend', [$user->email])}}" method="post">
						@csrf
						@method('patch')
						<input type="submit" value="Unfriend {{$user->getFirstNameOrEmail()}}" class="btn btn-primary">
					</form>
				@elseif(Auth::user()->id !== $user->id)
					<p><a href="{{route('add-friend', [$user->email])}}" class="btn btn-primary">Send Friend Request</a></p>
				@endif				
				<h4>{{$user->getFirstNameOrEmail()}}'s friends {{$user->friends()->count()? :''}}</h4>
				@if(!$user->friends()->count())
					{{$user->getFirstNameOrEmail()}} has no friends
				@else
					@foreach($user->friends() as $user)
						@include('pages.template.partials.userblock')
					@endforeach
				@endif
			</div>
		</div>
		
	</div>
@endsection