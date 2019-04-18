@auth
	<div class="row">
		<div class="col-lg-6">
			<form action="/status" method="post">
				@csrf
				<div class="form-group">
					<textarea name="timeline" id="status" cols="30" rows="3" class="form-control {{$errors->has('timeline')? 'is-invalid': ''}}" placeholder="What's up {{Auth::user()->getFirstNameOrEmail()}}?"></textarea>
					@if($errors->has('timeline'))
						<span class="invalid-feedback" role="alert">
							<strong>{{$errors->first('timeline')}}</strong>
						</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-outline-success" type="submit">Update</button>
				</div>
			</form>
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