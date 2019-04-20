@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<h2>{{$status->user->getFirstNameOrEmail()}}'s Timeline </h2>
				<hr>				
						@include('pages.template.partials.timeline',['conditionToRepyForm' => Auth::user()->isFriendsWith($status->user)])	
			</div>
		</div>
	</div>
@endsection