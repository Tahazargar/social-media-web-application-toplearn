<x-layout pageTitle="تغییر نمایه ">
    <div class="container container--narrow py-md-5 text-right tz-fix-height">
        <h2>آپلود تصویر</h2>
        <form action="/store-avatar" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <input type="file" name="avatar">
                @error('avatar')
                    <p class="alert text-xs alert-danger shadow-sm">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-sm btn-primary px-3 mt-3">آپلود</button>
        </form>
    </div>
</x-layout>