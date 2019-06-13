<a href="/user/{{$note->data['user']['email']}}">
	<img src="{{asset('storage/avatar/'.$note->data['image'])}}" class="rounded-circle"> &nbsp; &nbsp; 
	{{$note->data['user']['first_name'] ? $note->data['user']['first_name'] : $note->data['user']['email']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>