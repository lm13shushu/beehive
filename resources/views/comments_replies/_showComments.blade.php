@if (count($commentsList) > 0)
    <ol class="comments" style="list-style: none;">
        @foreach ($commentsList as $k => $comments)
          <div style="margin-bottom:10px;">
                @foreach($comments as $comment)
                        @include('comments_replies._singleComment',['comment_user' => $comment->user,'to_user'=>$comment->toUser])
                @endforeach
          </div>
          <hr style="width:600px;border-top:4px dotted #f5f5f5;">
        @endforeach
    </ol>
    @else
        <h3>暂无回复，赶快抢沙发！</h3>
@endif

