<x-layout :pageTitle="$pageTitle">
    <div class="container py-md-5 text-right container--narrow tz-fix-height">
        <h2>
          <img class="avatar-small" src="{{ $sharedData['avatar'] }}" /> {{ $sharedData['currentUsername'] }}
          @auth
          @if (!$sharedData['followingOrNot'] && auth()->user()->username != $sharedData['currentUsername'])
          <form class="ml-2 d-inline" action="/create-follow/{{ $sharedData['currentUsername'] }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> دنبال کردن </button>
          </form>
          @endif

          @if($sharedData['followingOrNot'])
          <form class="ml-2 d-inline" action="/remove-follow/{{ $sharedData['currentUsername'] }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm"> توقف دنبال کردن <i class="fas fa-user-times"></i></button>
          </form>
          @endif

          @if(auth()->user()->username == $sharedData['currentUsername'])
          <a href="/manage-avatar">
            <button class="btn btn-warning btn-sm text-white">تغییر آواتار</button>
          </a>
          @endif

          @endauth
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
          <a href="/profile/{{$sharedData['currentUsername']}}" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == '' ? 'active' : ''}}">پست ها: {{ $sharedData['postCount'] }}</a>
          <a href="/profile/{{$sharedData['currentUsername']}}/followers" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == 'followers' ? 'active' : ''}}">دنبال کنندگان: {{ $sharedData['followersCount'] }}</a>
          <a href="/profile/{{$sharedData['currentUsername']}}/followings" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == 'followings' ? 'active' : ''}}">دنبال شوندگان: {{ $sharedData['followingsCount'] }}</a>
        </div>

        {{ $slot }}
  
      </div>
</x-layout>