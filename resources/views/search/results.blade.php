@extends('pages.template.app')
@section('content')
	<div class="container">
		<h3>Your search for location/user <i>"{{Request::input('query')}}"</i></h3>
		@if($users->count())
			@foreach($users as $user)		
				@include('pages.template.partials.userblock')
			@endforeach
		@else
			No users found!
		@endif
	</div>

@endsection