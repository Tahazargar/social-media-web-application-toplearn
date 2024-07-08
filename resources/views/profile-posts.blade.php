<x-profile :sharedData="$sharedData">
  <div class="list-group text-right">
    @foreach ($posts as $post)
        <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{ $sharedData['avatar'] }}" />
            <strong>{{ $post->title }}</strong>
            <span class="text-muted small">توسط {{ $sharedData['currentUsername'] }} در {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y'); }}</span>
        </a>
    @endforeach
  </div>
</x-profile>