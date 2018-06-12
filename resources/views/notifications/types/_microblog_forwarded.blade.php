<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['forwardMicroblog_id']) }}">
        <img class="media-object img-thumbnail" alt="{{ $notification->data['forwardMicroblog_user_name'] }}" src="{{ $notification->data['forwardMicroblog_user_avatar'] }}"  style="width:48px;height:48px;"/>
        </a>
    </div>

    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['forwardMicroblog_user_id']) }}">{{ $notification->data['forwardMicroblog_user_name'] }}</a>
            转发了
            <a href="{{ $notification->data['initialMicroblog_link'] }}">您的微博:</a>
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="forwardMicroblog-content">
            并说:<a href="{{ route('microblogs.show',$notification->data['forwardMicroblog_id']) }}">{!! $notification->data['forwardMicroblog_content'] !!}</a>
        </div>
    </div>
</div>
<hr>