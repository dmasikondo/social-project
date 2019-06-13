<a href="/status/{{$note->data['status']['id']}}">
	@include('pages.template.partials.notifications.includes.avatar_image') 
	{{$note->data['liker']['first_name']? : $note->data['liker']['email']}} 
	{{$note->data['message']}}
	&nbsp; "{{str_limit($note->data['status']['body'], 14, '...')}}" 

	- {{$note->created_at->diffForHumans()}}
</a>

{{Auth::user()->unreadNotifications->markAsRead()}}