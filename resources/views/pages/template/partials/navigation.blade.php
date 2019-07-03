		<nav class="navbar navbar-expand-lg navbar-light fixed-top mb-5">
			<div class="container">
			  <a class="navbar-brand" href="/">Social Network</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			     @auth
			     @endauth
			    <form action="/search" class="form-inline">
			    	@csrf
			    	<div class="form-group">
			    		<input type="text" class="form-control input-search" placeholder="Find people" name="query" required="required">
				    	<button class="btn btn-default btn-search" type="submit">
				    		<i class="fa fa-search"></i>
				    	</button>		    		
			    	</div>

			    </form>		      
			    </ul>

				<ul class="navbar-nav">
				@auth
			      <li class="nav-item">
			      	<a href="#" class="nav-link">
			      		@include('pages.template.partials.avatar')
			      		{{Auth::user()->getFullnameOrEmail()}}
			      	</a>
			      </li>	
			      <li class="nav-item nav-icon">
			      	<a href="{{route('friends')}}" class="nav-link"><span class="fa fa-users"></span></a>
			      </li>				      
			      <li class="nav-item nav-icon">
			      	<a href="{{route('user-status',[Auth::user()->email])}}" class="nav-link"><span class="fa fa-user"></span></a>
			      </li>	
			      <li class="nav-item nav-icon">
			      	<a href="#" class="nav-link"><span class="fa fa-inbox"></span></a>
			      </li>			      		      			
					<li class="nav-item dropdown nav-icon">
						<a href="" class="nav-link dropdown-toggle" id="notificationDropDownLink" data-toggle="dropdown" role="button" aria-expanded="false">
							<span class="fa fa-bell"></span> 
								@if(auth()->user()->unreadNotifications->count())
									<span class="badge badge-danger"> {{auth()->user()->unreadNotifications->count()}}
									</span>								
								@endif	
						</a>
					<ul class="dropdown-menu settings-drop" aria-labelledby="notificationDropDownLink">
						@foreach(auth()->user()->unreadNotifications as $note)
							<li class="dropdown-item" style="background: #ccc">
								@include('pages.template.partials.notifications.'.snake_case(class_basename($note->type)))
							</li>
						@endforeach
							@foreach(auth()->user()->readNotifications as $note)
								<li class="dropdown-item">
									@include('pages.template.partials.notifications.'.snake_case(class_basename($note->type)))
								</li>
							@endforeach				
					</ul>
					<li class="nav-item dropdown nav-icon">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropDownMenuLink" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">						
	                        <span class="fa fa-lock"></span>
	                    </a>
						<div class="dropdown-menu settings-drop" aria-labelledby="navbarDropDownMenuLink">
							<a href="{{route('user-profile.edit')}}" class="dropdown-item">Update Profile</a>
							<a href="/#" class="dropdown-item">Privacy Settings</a>
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
			</div>
		</nav>
