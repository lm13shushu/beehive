<div class="microblog_status" style="width:100%;height:20px;margin-top:10px;">
    <div style="width:350px;border-radius: 5px;margin-left:50px;">
        <button class="btn btn-link forward" value="{{ $microblog->id }}" style="margin-left:10px;padding:0;" data-toggle="modal" data-target="#showForwardInterface">
            <span class="glyphicon glyphicon-retweet"></span>
            <span class="badge">{{ $microblog->forward_count }}</span>
        </button>
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