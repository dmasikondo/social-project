@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-5">					
						@auth
							<h2>{{Auth::user()->getFirstNameOrEmail()}}'s Timeline (My Timeline)</h2>
							<hr>
							@if(!$statuses->count())				
								<p>There is nothing on your timeline yet</p>
								@include('pages.template.partials.status_form')
							@else
							@include('pages.template.partials.status_form')
								@foreach($statuses as $status)				
									@include('pages.template.partials.timeline',['conditionToRepyForm' => Auth::user()->isFriendsWith($status->user)])
							@endforeach
							{!! $statuses->render() !!}
							@endif
						@endauth						
						@guest
						<h5 class="card-title">
							Welcome to Social
						</h5>						
						<h6 class="card-subtitle text-muted mb-2">Login to Find friends, Make friend requests, upload your status and respond to others</h6>			
						@endguest			
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection