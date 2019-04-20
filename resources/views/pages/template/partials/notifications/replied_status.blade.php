<a href="/status/{{$note->data['status']['id']}}">
	{{$note->data['replier']['first_name']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>
{{Auth::user()->unreadNotifications->markAsRead()}}