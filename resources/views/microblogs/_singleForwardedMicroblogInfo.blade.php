<div class="forwardMicroblogInfo" style="margin-left:50px;margin-top:-10px;">
    <div class="forwardMicroblogContent">
        {{-- 加载转发微博中的转发信息 --}}
        @foreach($initialMicroblog->forwardMicroblogsOrder($microblog->created_at) as $forwardMicroblog)
            @if($forwardMicroblog->content)
                <a href="{{ route('users.show', $forwardMicroblog->user_id ) }}">@ {{ $forwardMicroblog->user->name }}</a>&nbsp;转发说：&nbsp;{{  $forwardMicroblog->content  }}
                <span>//</span>
            @endif
        @endforeach
    </div>
    <div class="initialMicroblog" style="padding: 10px;background-color: #E6E6FA;border-radius:10px;">
        <a href="{{ route('users.show', $initialUser->id )}}">
            <img src="{{ $initialUser->avatar }}" alt="{{ $initialUser->name }}" class="img-circle" width="45px" height="45px"/>
        </a>
        <div style="margin-left:48px;margin-top:-50px;">
            <div>
                <a href="{{ route('users.show', $initialUser->id ) }}">{{ $initialUser->name }}</a>
            </div>
            <div>
                <!-- 该方法的作用是将日期进行友好化处理 -->
                {{ $initialMicroblog->created_at->diffForHumans() }}
            </div>
            <span><a href="{{ route('categories.show', $microblog->category_id ) }}" class="category" style="color:#286090">#{{ $initialMicroblog->category }}#</a>{!! $initialMicroblog->content !!}</span>
        </div>
    </div>
</div>
<div class="microblog_status" style="width:100%;height:20px;margin-top:10px;">
    <div style="width:350px;border-radius: 5px;margin-left:50px;">
        <button class="btn btn-link forward" value="{{ $initialMicroblog->id }}" style="margin-left:10px;padding:0;" data-toggle="modal" data-target="#showForwardInterface">
            <span class="glyphicon glyphicon-retweet"></span>
            <span class="badge">{{ $microblog->forward_count }}</span>
        </button>
        <a href="javascript:void(0);" style="margin-left:40px">
            <span class="glyphicon glyphicon-thumbs-up like" id="{{ $microblog->id }}"></span>
            <span class="badge" id="like-count-{{ $microblog->id }}">{{ $microblog->like_count }}</span>
        </a>
        <a href="{{ route('microblogs.show',$microblog->id) }}" style="margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span>
            <span class="badge">{{ $microblog->reply_count }}</span>
        </a>
        <a href="#">
            <span class="glyphicon glyphicon-eye-open" style="margin-left:40px"></span>
            <span class="badge">{{ $microblog->view_count }}</span>
        </a>
    </div>
</div>