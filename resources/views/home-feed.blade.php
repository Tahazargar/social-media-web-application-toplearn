<x-layout pageTitle="صفحه اصلی">
    <div class="container py-md-5 container--narrow tz-fix-height">
        @unless ($posts->isEmpty())
        <div class="text-center mb-3">
          <h2 class="mb-4">آخرین پست های کاربرانی که آن ها را دنبال کرده اید</h2>
          <div class="list-group text-right">
            @foreach ($posts as $post)
            <x-post :post="$post"/>
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