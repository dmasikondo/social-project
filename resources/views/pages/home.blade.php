@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="card">
				<div class="card-body">
						@includeWhen(@auth, 'timeline.index')
						@guest
						<h5 class="card-title">
							Welcome to Social
						</h5>						
						<h6 class="card-subtitle text-muted mb-2">Login to Find friends, Make friend requests, upload your status and respond to others</h6>			
						@endguest			
				</div>
		</div>
	</div>
@endsection