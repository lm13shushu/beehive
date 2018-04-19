@if (count($microblogs) > 0)
    <ol class="microblogs">
        @foreach ($microblogs as $microblog)
            <li id="microblogs-{{ $microblog->id }}">
                <a href="{{ route('users.show', $user->id )}}">
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar img-circle" width="45px" height="45px"/>
                </a>
                <span class="user">
                    <a href="{{ route('users.show', $user->id ) }}">{{ $user->name }}</a>
                </span>
                <span class="timestamp">
                     <!-- 该方法的作用是将日期进行友好化处理 -->
                     {{ $microblog->created_at->diffForHumans() }}
                </span>
                <span class="content">{{ $microblog->content }}</span>
                @can('destroy', $microblog)
                    <form action="{{ route('microblogs.destroy', $microblog->id) }}" method="POST" style="float:right;margin-top:-10px; ">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ol>
     {!! $microblogs->render() !!}
@endif



