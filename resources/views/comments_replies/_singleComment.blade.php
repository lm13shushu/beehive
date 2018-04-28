<li id="comments-{{ $comment->id }}" style="margin-top:50px;border-bottom:1px solid #f5f5f5;margin:10px auto;">
    @for ($i=0;$i<$comment->depth;$i++)
         &nbsp;&nbsp;&nbsp;&nbsp;
    @endfor
    <a href="{{ route('users.show', $comment_user->id )}}">
        <img src="{{ $comment_user->avatar }}" alt="{{ $comment_user->name }}" class="avatar img-circle" width="45px" height="45px"/>
    </a>
    <span class="user">
        <a href="{{ route('users.show', $comment_user->id ) }}">{{ $comment_user->name }}</a>
    </span>
    @if($comment->parent_id != 0)
        <span>回复</span>
        <span class="user">
            <a href="{{ route('users.show', $comment_user->id ) }}">{{ "@".$comment_user->name }}</a>
        </span>
    @endif
    <span class="timestamp" style="color: #727b20;">
         <!-- 该方法的作用是将日期进行友好化处理 -->
         {{ $microblog->created_at->diffForHumans() }}
    </span>
    <span class="content">{{ $comment->content }}</span>
    <button  class="show-reply btn btn-link" id="show-reply-{{ $comment->id }}" value="{{ $comment->id }}">回复</button>
     @can('destroy', $comment)
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="float: right;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-link  status-delete-btn">删除</button>
        </form>
    @endcan

    <form class="replyForm" id="replyForm-{{ $comment->id }}" action="{{ route('comments.storeReplies',['microblog'=>$microblog->id,'comment'=>$comment->id]) }}" method="POST"  style="display:none;">
        @include('common.error')
        {{ csrf_field() }}
        <textarea class="form-control" rows="3" placeholder="发表回复..." name="content">{{ old('content') }}</textarea>
        <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">回复</button>
    </form>
</li>
