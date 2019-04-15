		<nav class="navbar navbar-expand-lg navbar-light bg-light container">
		  <a class="navbar-brand" href="/">Social Network</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarText">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="#">Timeline <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Friends</a>
		      </li>
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
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropDownMenuLink" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">{{ Auth::user()->email }}</a>
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