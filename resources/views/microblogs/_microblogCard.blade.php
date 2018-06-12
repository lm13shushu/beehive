    <div class = "col-md-12 panel panel-default microblogs" style="margin:5px 0px;">
        <div style="margin:0px 0px 10px 20px;">
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
            <a href="{{ Route('microblogs.show',$microblog->id) }}">查看该微博>>></a>
        </div>
    </div>
   