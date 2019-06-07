		<nav class="navbar navbar-expand-lg navbar-light bg-light container">
		  <a class="navbar-brand" href="/">Social Network</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarText">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="{{route('friends')}}">Friends</a>
		      </li>
		     @auth
		      <li class="nav-item">
		      	<a href="{{route('user-status',[Auth::user()->email])}}" class="nav-link">Statuses</a>
		      </li>
		     @endauth
		    <form action="/search" class="form-inline">
		    	@csrf
		    	<div class="form-group">
		    		<input type="text" class="form-control" placeholder="Find people" name="query">
			    	<button class="btn btn-outline-success" type="submit">
			    		<span class="icon-search icon-white">Search</span>
			    	</button>		    		
		    	</div>

		    </form>		      
		    </ul>

			<ul class="navbar-nav">
			@auth
				<li class="nav-item dropdown">
					<a href="" class="nav-link dropdown-toggle" id="notificationDropDownLink" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="fa fa-globe"></span>
							Notifications 
							@if(auth()->user()->unreadNotifications->count())
							<span class="badge badge-danger"> {{auth()->user()->unreadNotifications->count()}}
							</span>								
							@endif	
					</a>
			@if(auth()->user()->unreadNotifications->count())
				<ul class="dropdown-menu" aria-labelledby="notificationDropDownLink">
					@foreach(auth()->user()->unreadNotifications as $note)
					<li class="dropdown-item">
						@include('pages.template.partials.notifications.'.snake_case(class_basename($note->type)))
					</li>
					@endforeach
				</ul>
			@else
				<ul class="dropdown-menu" aria-labelledby="notificationDropDownLink">
					<li class="dropdown-item">
						You have no unread notifications
					</li>
				</ul>			
			@endif
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropDownMenuLink" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">{{ Auth::user()->getFirstNameOrEmail() }}</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropDownMenuLink">
						<a href="{{route('user-profile.edit')}}" class="dropdown-item">Update Profile</a>
						<a href="/logout" class="dropdown-item">Logout</a>
					</div>
				</li>
			@endauth
			@guest				
				<li class="nav-item">
					<a href="/register" class="nav-link">Sign Up</a>
				</li>
				<li class="nav-item">
					<a href="/login" class="nav-link">Sign In</a>
				</li>
			@endguest				
			</ul>
		  </div>
		</nav>