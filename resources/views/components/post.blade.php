<a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
    <img class="avatar-tiny" src="{{ $post->user->avatar }}" />
    <strong>{{ $post->title }}</strong>
    <span class="text-muted small">
        @if (!isset($hideAuthor))
        توسط {{ $post->user->username }}
        @endif
         در {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y'); }}
    </span>
</a>
