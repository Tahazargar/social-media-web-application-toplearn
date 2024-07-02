<x-layout>
    <div class="container py-md-5 container--narrow tz-fix-height">
        <div class="d-flex justify-content-between">
          <h2>{{ $post->title }}</h2>
          <span class="pt-2">
            <a href="#" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="ویرایش"><i class="fas fa-edit"></i></a>
            <form class="delete-post-form d-inline" action="#" method="POST">
              <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="حذف"><i class="fas fa-trash"></i></button>
            </form>
          </span>
        </div>
  
        <p class="text-muted text-right small mb-4">
          <a href="#"><img class="avatar-tiny" src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
          پست شده توسط <a href="#">{{ $post->user->username }}</a> در {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y'); }}</p>
  
        <div class="body-content text-justify">
          <p>{{ $post->body }}</p>
        </div>
      </div>
</x-layout>