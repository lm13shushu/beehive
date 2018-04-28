<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\MicroblogReplied;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CommentObserver
{
     public function created(Comment $comment)
    {
        $microblog = $comment->microblog;
        //$microblog->increment('reply_count', 1);

        // 通知作者话题被回复了，自定义notify方法
        $microblog->user->notify(new MicroblogReplied($comment));
    }
}