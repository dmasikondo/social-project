<a href="/status/{{$note->data['status']['id']}}">
	{{$note->data['poster']['first_name']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>