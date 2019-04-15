			<div class="media">
				<span class="fa fa-user mr-2" width="2em" height="2em"></span>
				<div class="media-body">
					<h5>
						<a href="/user/{{$user->email}}">{{$user->getFirstNameOrEmail()}}</a>
					</h5>
					@if($user->location)
						<p>{{$user->location}}</p>
					@endif
				</div>
			</div>
