@extends('pages.template.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Edit My Profile
					</div>
					<div class="card-body">
						<form action="{{route('post.user-profile')}}" method="post" enctype="multipart/form-data">
						@csrf
						@method('patch')
							<div class="form-group">
								<label for="firstname" id="firstname">FirstName</label>
								<input type="text" name="firstname" class="form-control {{$errors->has('firstname')? 'is-invalid' : ''}}" value="{{old('firstname')? : Auth::user()->first_name}}">
								@if($errors->has('firstname'))
									<span class="invalid-feedback" role="alert">
										<strong>{{$errors->first('firstname')}}</strong>
									</span>
								@endif
							</div>	
							<div class="form-group">
								<label for="lastname" id="lastname">LastName</label>
								<input type="text" name="lastname" class="form-control {{$errors->has('lastname')? 'is-invalid' : ''}}" value="{{old('lastname')? : Auth::user()->last_name}}">
								@if($errors->has('lastname'))
									<span class="invalid-feedback" role="alert">
										<strong>{{$errors->first('lastname')}}</strong>
									</span>
								@endif								
							</div>	
							<div class="form-group">
								<label for="location" id="location">Location</label>
								<input type="text" name="location" class="form-control {{$errors->has('location')? 'is-invalid' : ''}}" value="{{old('location')? : Auth::user()->location}}">
								@if($errors->has('location'))
									<span class="invalid-feedback" role="alert">
										<strong>{{$errors->first('location')}}</strong>
									</span>
								@endif								
							</div>
							<div class="form-group d-flex flex-column">
								<label for="image" id="image">Update Profile Picture 
								@foreach($image as $image)
									<img src="{{asset('storage/uploads/'.$image->name)}}" alt="" width="200"   align="right" class="rounded-circle">
								@endforeach
								</label>
								<input type="file" name="image" class="form-control {{$errors->has('image')? 'is-invalid' : ''}}" value="{{old('image')? : Auth::user()->image}} py-2" accept="image/png, image/jpeg, image/jpg, image/gif, image/bmp">
								@if($errors->has('image'))
									<span class="invalid-feedback" role="alert">
										<strong>{{$errors->first('image')}}</strong>
									</span>
								@endif								
							</div>							
							<div class="form-group">
								<button class="btn btn-outline-success" type="submit">Update</button>
							</div>															
						</form>
					</div>
				</div>				
			</div>
		</div>		
	</div>
@endsection