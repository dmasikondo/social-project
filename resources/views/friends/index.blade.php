@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h4>Your friends</h4>
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
				<!-- list of friend requests-->
			</div>
		</div>
	</div>
@endsection