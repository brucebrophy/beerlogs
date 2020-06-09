@component('mail::message')

# {{ $comment->user->username }} left a comment!

@component('mail::panel')
	{{ $comment->body }}
@endcomponent

@if($comment->commentable_type === 'App\Beers\Beer')
@component('mail::button', ['url' => route('beers.show', $comment->commentable->slug)])
Click here to reply!
@endcomponent
@endif

@endcomponent
