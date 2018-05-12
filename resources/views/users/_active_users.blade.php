@if (count($active_users))
    <div class="text-center"><b>活跃用户</b></div>
    <hr>
    @foreach ($active_users as $active_user)
        <a class="media" href="{{ route('users.show', $active_user->id) }}">
            <div class="media-left media-middle">
                <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="img-circle media-object">
            </div>

            <div class="media-body">
                <span class="media-heading">{{ $active_user->name }}</span>
            </div>
        </a>
    @endforeach
@endif