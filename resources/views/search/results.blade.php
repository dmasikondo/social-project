@extends('pages.template.app')
	<div class="spacer"></div>
@section('content')
	<div class="container">
		<h3>Your search for location/user <i>"{{Request::input('query')}}"</i></h3>
			@foreach($profiles as $user)		
				@include('pages.template.partials.userblock')
			@endforeach
		
	</div>

@endsection