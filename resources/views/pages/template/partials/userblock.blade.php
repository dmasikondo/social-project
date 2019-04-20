			<div class="media">
				<span class="fa fa-user mr-2 mt-3"></span>
				<div class="media-body">
					<h5>
					@if($user['first_name'])
						<a href="/user/{{$user['email']}}">{!!$user['first_name']=str_replace($query, "<span class='badge badge-warning'>$query</span>",$user['first_name'? : 'email'])!!}</a>
					@endif
					</h5>
					@if($user['location'])
						<p>{!!$user['location'] =str_replace($query, "<span class='badge badge-warning'>$query</span>",$user['location'])!!}</p>
					@endif
				</div>
			</div>
