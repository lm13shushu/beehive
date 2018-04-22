<li>
    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar img-circle" width="62px" height="62px"/>
    <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>
</li>