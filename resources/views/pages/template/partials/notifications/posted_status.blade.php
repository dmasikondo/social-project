<a href="/status/{{$note->data['status']['id']}}">
	@include('pages.template.partials.notifications.includes.avatar_image') 
	{{$note->data['poster']['first_name']? : $note->data['poster']['email']}} 
	{{$note->data['message']}} 
	&nbsp; "{{str_limit($note->data['status']['body'], 14, '...')}}"
	- {{$note->created_at->diffForHumans()}}
</a>