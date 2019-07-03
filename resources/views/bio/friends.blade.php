						<div class="card-body">
							<h5>
								<span class="fa fa-users">
									Friends								
								</span>
								<span class="float-right small">
									<a href="">Find Friends</a>
								</span>
							</h5>
							<div class="row">
								@foreach(Auth::user()->friends() as $friend)
									<div class="col-md-5">
										<div class="card mb-1">
											<img src="{{asset('storage/uploads/'.$friend->nameOfProfileImage())}}" class="img-responsive featured-image" alt="{{$friend->getFullnameOrEmail()}}"> &nbsp;
											<div class="card-img-overlay">
		              							<p class="card-text">{{$friend->getFullnameOrEmail()}}</p>
		            						</div>										
										</div>										
									</div>
								@endforeach								
							</div>

						</div>