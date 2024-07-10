<x-profile :sharedData="$sharedData" pageTitle="پروفایل {{ $sharedData['currentUsername'] }}">
  <div class="list-group text-right">
    @foreach ($posts as $post)
    <x-post :post="$post" hideAuthor/>
    @endforeach
  </div>
</x-profile>