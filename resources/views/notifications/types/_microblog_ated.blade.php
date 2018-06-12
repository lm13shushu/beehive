<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
        <img class="media-object img-thumbnail" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}"  style="width:48px;height:48px;"/>
        </a>
    </div>

    <div class="infos" >
        <div class="media-heading">    
             <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>   
            在新发的微博中 @ 了你<a href="{{ $notification->data['link'] }}">这里是微博链接</a>
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
<hr>