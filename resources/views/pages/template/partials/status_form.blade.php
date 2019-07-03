			<form action="/status" method="post">
				@csrf
				<div class="form-group">
					  <div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">@include('pages.template.partials.avatar')</div>
				        </div>
							<textarea name="timeline" id="timeline" cols="30" rows="3" class="form-control {{$errors->has('timeline')? 'is-invalid': ''}} align-middle" placeholder="What's up {{Auth::user()->getFirstNameOrEmail()}}?" required="required">								
							</textarea>
						</div>
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