	 
		@if(Auth::user()->hasFriendRequestPending($user))
			Waiting for {{$user->getFirstNameOrEmail()}} to accept
		@elseif(Auth::user()->hasFriendRequestReceived($user))
			<a href="{{route('accept-friend', [$user->email])}}" class="btn btn-primary">Accept</a>
		@elseif(Auth::user()->isFriendsWith($user))
		<div class="pull-right">
			<span class="fa fa-check"> Friends</span>		
			<form action="{{route('remove-friend', [$user->email])}}" method="post">
				@csrf
				@method('patch')
				<span class="fa fa-minus"></span>
				<input type="submit" value="Remove" class="btn btn-light">
			</form>
		</div>
		@elseif(Auth::user()->id !== $user->id)
			
				<a href="{{route('add-friend', [$user->email])}}" class="btn btn-primary">
					<span class="fa fa-user-plus"> Add Friend</span>
				</a>
		@elseif(Auth::user()->id == $user->id)	
			<span> Me </span>
		@endif
