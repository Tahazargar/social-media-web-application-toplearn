<x-layout>
    <div class="container py-md-5 container--narrow tz-fix-height">
        @unless ($posts->isEmpty())
        <div class="text-center">
          <h2>آخرین پست های کاربرانی که آن ها را دنبال کرده اید</h2>
          <div class="list-group text-right">
            @foreach ($posts as $post)
                <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
                    <img class="avatar-tiny" src="{{ $post->user->avatar }}" />
                    <strong>{{ $post->title }}</strong>
                    <span class="text-muted small">توسط {{ $post->user->username }} در {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y'); }}</span>
                </a>
            @endforeach
          </div>
        </div>

        {{ $posts->links() }}
        @else
        <div class="text-center">
          <h2>برای مشاهده پست، باید حداقل یک کاربر را دنبال کرده باشید.</h2>
        </div>
        @endunless
    </div>  
</x-layout>