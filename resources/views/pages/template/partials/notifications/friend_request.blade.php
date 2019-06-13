<a href="/user/{{$note->data['requester']['email']}}">
	@include('pages.template.partials.notifications.includes.avatar_image') 
	{{$note->data['requester']['first_name'] ? $note->data['requester']['first_name'] : $note->data['requester']['email']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>

{{Auth::user()->unreadNotifications->markAsRead()}}