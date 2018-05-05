<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['comment_user_id']) }}">
        <img class="media-object img-thumbnail" alt="{{ $notification->data['comment_user_name'] }}" src="{{ $notification->data['comment_user_avatar'] }}"  style="width:48px;height:48px;"/>
        </a>
    </div>

    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['comment_user_id']) }}">{{ $notification->data['comment_user_name'] }}</a>
            评论了
            <a href="{{ $notification->data['link'] }}">{{ $notification->data['to_comment']? $notification->data['to_comment'][0]['content'] : $notification->data['microblog_content'] }}</a>

            {{-- 回复删除按钮 --}}
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="reply-content">
            {!! $notification->data['comment_content'] !!}
        </div>
    </div>
</div>
<hr>