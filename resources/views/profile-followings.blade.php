<x-profile :sharedData="$sharedData" pageTitle="دنبال شوندگان {{ $sharedData['currentUsername'] }}">
  <div class="list-group text-right">
    @foreach ($followings as $following)
        <a href="/profile/{{ $following->userBeignFollowed->username }}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{ $following->userBeignFollowed->avatar }}" />
            {{ $following->userBeignFollowed->username }}
        </a>
    @endforeach
  </div>
</x-profile>