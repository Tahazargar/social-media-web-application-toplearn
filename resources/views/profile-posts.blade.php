<x-profile :sharedData="$sharedData" pageTitle="پروفایل {{ $sharedData['currentUsername'] }}">
  @include('profile-posts-only')
</x-profile>