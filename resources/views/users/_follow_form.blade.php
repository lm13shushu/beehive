@if ($user->id !== Auth::user()->id)
    @if (Auth::user()->isFollowing($user->id))
          <form action="{{ route('followers.destroy', $user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm">取消关注</button>
          </form>
    @else
          <form action="{{ route('followers.store', $user->id) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-primary">关注</button>
          </form>
    @endif
@else
    <a href="{{ route('users.edit', Auth::id()) }}"><span class="btn btn-sm btn-default">个人资料编辑</span></a>
@endif