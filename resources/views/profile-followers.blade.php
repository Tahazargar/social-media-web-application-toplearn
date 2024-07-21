<x-profile :sharedData="$sharedData" pageTitle="دنبال کنندگان {{ $sharedData['currentUsername'] }}">
  @include('profile-followers-only')
</x-profile>