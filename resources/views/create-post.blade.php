<x-layout pageTitle="پست جدید">
    <div class="container text-right tz-fix-height py-md-5 container--narrow">
        <form action="/create-post" method="POST">
          @csrf
          <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>عنوان</small></label>
            <input name="title" value="{{ old('title') }}" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
            @error('title')
              <p class="alert text-xs alert-danger shadow-sm">{{ $message }}</p>
            @enderror
          </div>
  
          <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>محتوای پیام</small></label>
            <textarea name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{ old('body') }}</textarea>
            @error('body')
            <p class="m-0 text-sm alert alert-danger shadow-sm">{{ $message }}</p>
          @enderror
          </div>
  
          <button type="submit" class="btn btn-primary">ذخیره پست جدید</button>
        </form>
      </div>
</x-layout>

