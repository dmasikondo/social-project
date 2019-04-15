@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				@include('pages.template.partials.userblock')
				<hr>
			</div>
			<div class="col-lg-4 offset-lg-3">
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