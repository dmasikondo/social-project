<a href="/user/{{$note->data['requester']['email']}}">
	{{$note->data['requester']['first_name'] ? $note->data['requester']['first_name'] : $note->data['requester']['email']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>