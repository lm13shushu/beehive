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
    <span class="content"><span class="category" style="color:#286090">#{{ $microblog->category }}#</span>{!! $microblog->content !!}</span>
    <div class="microblog_status" style="width:100%;height:20px;margin-top:10px;">
        <div style="width:350px;border-radius: 5px;margin-left:50px;">
            <a href="#" style="margin-left:10px">
                <span class="glyphicon glyphicon-retweet"></span>
                <span class="badge">20</span>
            </a>
            <a href="javascript:void(0);" style="margin-left:40px">
                <span class="glyphicon glyphicon-thumbs-up like" id="{{ $microblog->id }}"></span>
                <span class="badge" id="like-count-{{ $microblog->id }}">{{ $microblog->like_count }}</span>
            </a>
            <a href="{{ Route('microblogs.show',$microblog->id) }}" style="margin-left:40px">
                <span class="glyphicon glyphicon-comment"></span>
                <span class="badge">{{ $microblog->reply_count }}</span>
            </a>
            <a href="#">
                <span class="glyphicon glyphicon-eye-open" style="margin-left:40px"></span>
                <span class="badge">{{ $microblog->view_count }}</span>
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