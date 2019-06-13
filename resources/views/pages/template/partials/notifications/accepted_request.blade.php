<a href="/user/{{$note->data['acceptor']['email']}}">
	@include('pages.template.partials.notifications.includes.avatar_image') 
	{{$note->data['acceptor']['first_name'] ? $note->data['acceptor']['first_name'] : $note->data['acceptor']['email']}} {{$note->data['message']}} - {{$note->created_at->diffForHumans()}}
</a>

{{Auth::user()->unreadNotifications->markAsRead()}}