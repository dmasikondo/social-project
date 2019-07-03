						<div class="card mb-1">
							<div class="row">
								<div class="col-md-1 pl-2">
									<img src="{{asset('storage/avatar/avatar'.$user->nameOfAvatarImage())}}" class="rounded-circle">
								</div>
								<div class="col-md-11">
									<div class="card-body">
										<p class="card-text pull-right">
											@include('friends.friendship_status')
										</p>										
										<h6 class="card-title">
											<a href="/user/{{$user->email}}">{{$user->getFirstNameOrEmail()}}</a>
										</h6>										
										<p class="card-text">
											<small class="text-muted">
												{{$user->location}}
											</small>
										</p>
									</div>
								</div>
							</div>
						</div>
