@extends('pages.template.app')
@section('content')
@include('timeline.partials.profile_header',['uzer'=>$user])
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

					<div class="card mb-1">
						<div class="card-header">
							<p>@include('friends.friendship_status')</p>
							@if(Auth::user()->id == $user->id)
								<h6>My friends {{Auth::user()->friends()->count()}}</h6>
							@else					
								<h6>
									{{$user->getFirstNameOrEmail()}}'s friends {{$user->friends()->count()? :''}}						
								</h6>						
							@endif						
						</div>
					</div>
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