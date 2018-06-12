<li id="microblogs-{{ $microblog->id }}">
    {{-- 删除 --}}
    @can('destroy', $microblog)
        <form action="{{ route('microblogs.destroy', $microblog->id) }}" method="POST" style="float:right;position: relative; margin-top:10px;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan

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
    <span class="content"><a href="{{ route('categories.show', $microblog->category_id ) }}" class="category" style="color:#286090">#{{ $microblog->category }}#</a>{!! $microblog->content !!}</span>
    {{-- 微博点赞、转发、评论 --}}
    @include('microblogs._microblog_status')
</li>