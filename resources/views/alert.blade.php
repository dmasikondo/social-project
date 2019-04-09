	@if(Session::has('info'))
	<div class="container">
		<div class="alert alert-info alert-dismissible fade show" role="alert">
		  {{Session::get('info')}}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>		
	@endif
