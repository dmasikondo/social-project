@if($friend_photo->count())
	@foreach($friend_photo as $image)
		<img src="{{asset('storage/uploads/'.$image->name)}}" alt="{{Auth::user()->getFullnameOrEmail()}} featured-image" class ="featured-image">
	@endforeach
@else
	<img src="{{asset('storage/uploads/default.jpg')}}" alt="featured-image" class="black-white" class ="featured-image">	
@endif