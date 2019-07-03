@if($images->count())
	@foreach($images as $image)
		<img src="{{asset('storage/uploads/'.$image->name)}}" alt="{{$uzer->getFullnameOrEmail()}} profile image" class="profile-image">
	@endforeach
@else
	<img src="{{asset('storage/uploads/default.jpg')}}" alt="profile image default" class="profile-image black-white">	
@endif