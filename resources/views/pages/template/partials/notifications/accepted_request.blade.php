<a href="/user/{{$note->data['acceptor']['email']}}">
	{{$note->data['acceptor']['first_name']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>