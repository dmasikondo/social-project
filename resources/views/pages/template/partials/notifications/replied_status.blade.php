<a href="/status/{{$note->data['status']['id']}}">
	@include('pages.template.partials.notifications.includes.avatar_image') 
	{{$note->data['replier']['first_name']? : $note->data['replier']['email']}} {{$note->data['message']}} 
	&nbsp; "{{str_limit($note->data['status']['body'], 14, '...')}}"
	- {{$note->created_at->diffForHumans()}}
</a>
{{Auth::user()->unreadNotifications->markAsRead()}}