<div class="list-group text-right">
    @foreach ($posts as $post)
    <x-post :post="$post" hideAuthor/>
    @endforeach
</div>