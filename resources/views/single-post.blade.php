<x-layout>
    <div class="container py-md-5 container--narrow tz-fix-height">
        <div class="d-flex justify-content-between">
          <h2>{{ $post->title }}</h2>
          @can('update', $post)
          <span class="pt-2">
            <a href="/post/{{ $post->id }}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="ویرایش"><i class="fas fa-edit"></i></a>
            <form class="delete-post-form d-inline" action="/post/{{ $post->id }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="حذف"><i class="fas fa-trash"></i></button>
            </form>
          </span>
          @endcan
        </div>
  
        <p class="text-muted text-right small mb-4">
          <a href="/profile/{{$post->user->username}}"><img class="avatar-tiny" src="{{ $post->user->avatar }}" /></a>
          پست شده توسط <a href="/profile/{{$post->user->username}}">{{ $post->user->username }}</a> در {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y'); }}</p>
  
        <div class="body-content text-justify">
          <p>{{ $post->body }}</p>
        </div>
      </div>
</x-layout>