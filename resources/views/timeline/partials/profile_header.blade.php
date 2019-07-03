		<div class="card profile-card">
			<div class="container">
				<div class="profile">
					@include('pages.template.partials.profile_image')
					<a href="#" class="profile-name">
						{{$uzer->getFullnameOrEmail()}}
						<i class="fa fa-ok"></i>
					</a>
				@auth
					@if($uzer->id == Auth::user()->id)
						@if(!$uzer->images()->where('isprofile', true)->count())
							<p class="location">
								<a href="{{route('user-profile.edit')}}" class="btn btn-outline-primary">
								@if($uzer->location)
									Update ProfilePic								
									<span class="badge badge-danger">
										1
									</span>
								@else							
									Update Info & ProfilePic								
									<span class="badge badge-danger">
										3
									</span>
								@endif
									</span>					
								</a>							
							</p>
						@endif
							<p class="location">{{!is_null($uzer->location)? $uzer->location : 'Location not updated'}}</p>									
					@endif
				@endauth
				</div>
			</div>
		</div>