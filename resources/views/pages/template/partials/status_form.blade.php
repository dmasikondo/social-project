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