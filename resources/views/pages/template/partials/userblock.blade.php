			<div class="media">
				<img src="{{asset('storage/avatar/avatar'.$user->nameOfAvatarImage())}}" class="rounded-circle"> &nbsp;
				<div class="media-body">
					<h5>
						<a href="/user/{{$user->email}}">{!!$user->first_name = str_replace($query, "<span class='font-weight-bolder'>$query</span>",$user->first_name ? : $user->email)!!}
						</a>
					</h5>
					@if($user->location)
						<p><span class="fa fa-map-marker"> &nbsp; </span>{!!$user->location =str_replace($query, "<span class='font-weight-bolder'>$query</span>",$user->location)!!}</p>
					@endif
					
				</div>
			</div>
