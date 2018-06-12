<div class="well initialMicroblog" style="margin: 0;">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar img-circle" width="45px" height="45px"/>
    </a>
    <div style="margin-left:46px;margin-top:-50px">
        <div class="user">
            <a href="{{ route('users.show', $user->id ) }}">{{ $user->name }}</a>
        </div>
        <div class="timestamp">
            <!-- 该方法的作用是将日期进行友好化处理 -->
            {{ $microblog->created_at->diffForHumans() }}
        </div>
        <span class="content" ><span class="category" style="color:#286090">#{{ $microblog->category }}#</span>{!! $microblog->content !!}</span>
    </div>
    @include('microblogs._microblog_status')
</div>