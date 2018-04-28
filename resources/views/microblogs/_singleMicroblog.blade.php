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
    <div class="microblog_status" style="width:100%;height:20px;margin-top:10px;">
        <div style="width:240px;background-color:#ffffff;border-radius: 5px;margin-left:50px;">
            <a href="#" style="margin-left:20px">
                <span class="glyphicon glyphicon-retweet">10</span>
            </a>
            <a href="#" style="margin-left:20px">
                <span class="glyphicon glyphicon-hand-right">2000</span>
            </a>
            <a href="{{ Route('microblogs.show',$microblog->id) }}" style="margin-left:20px">
                <span class="glyphicon glyphicon-comment">3000</span>
            </a>
        </div>
    </div>
    @can('destroy', $microblog)
        <form action="{{ route('microblogs.destroy', $microblog->id) }}" method="POST" style="float:right;margin-top:-100px;position: relative; ">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan
</li>