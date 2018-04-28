@if (count($commentsList) > 0)
    <ol class="comments" style="list-style: none;">
        @foreach ($commentsList as $k => $comments)
                @foreach($comments as $comment)
                        @include('comments_replies._singleComment',['comment_user' => $comment->user])
                @endforeach
        @endforeach
    </ol>
@endif

