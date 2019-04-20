@auth
	<div class="row">
		<div class="col-lg-6">
			@include('pages.template.partials.status_form')
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
				@include('pages.template.partials.timeline',[
						'statusTitle' => "",
						'nothingOnTimeline' => "There is nothing on your timeline yet",
						'conditionToRepyForm' => Auth::user(),
					])
		</div>
	</div>
@endauth