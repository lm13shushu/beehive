<div class = "userInfo">
    <div class="user_avatar" style="text-align: center;">
        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar img-circle" width="62px" height="62px" style="display: inline-block;" />
        <h4>{{ $user->name }}</h4>
    </div>
    <div class="stats">
      <a href="{{ route('users.followings', $user->id) }}">
        <strong id="following" class="stat">
          {{ count($user->followings) }}
        </strong>
        关注
      </a>
      <a href="{{ route('users.followers', $user->id) }}">
        <strong id="followers" class="stat">
          {{ count($user->followers) }}
        </strong>
        粉丝
      </a>
      <a href="{{ route('users.show', $user->id) }}">
        <strong id="microblogs" class="stat">
          {{ $user->microblogs()->count() }}
        </strong>
        微博
      </a>
    </div>
</div>
