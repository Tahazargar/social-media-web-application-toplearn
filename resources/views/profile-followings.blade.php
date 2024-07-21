<x-profile :sharedData="$sharedData" pageTitle="دنبال شوندگان {{ $sharedData['currentUsername'] }}">
  @include('profile-followings-only')
</x-profile>