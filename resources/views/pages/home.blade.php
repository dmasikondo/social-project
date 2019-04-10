@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="card">
				<div class="card-body">
					
					<h5 class="card-title">
						Welcome to Social
						@auth
							{{Auth::user()->email}}
						
					</h5>
					<h6 class="card-subtitle text-muted mb-2">Enjoy your stay</h6>	
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>	
						@endauth
						@guest
							<h6 class="card-subtitle text-muted mb-2">Login to enjoy full benefits</h6>						
						@endguest			
				</div>
		</div>
	</div>
@endsection