<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\MicroblogReplied;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CommentObserver
{
     public function saved(Comment $comment)
    {
        if($comment->microblog_id==null){
            //找到回复所在微博
            $microblog=$comment->getRoot()->microblog;
            //通知回复作者被回复了
            $comment->toUser->notify(new MicroblogReplied($comment,$microblog));
        }else{
            $microblog = $comment->microblog;
             // 通知作者话题被回复了，自定义notify方法
            $microblog->user->notify(new MicroblogReplied($comment,$microblog));
        }
        //dd($microblog);
        $microblog->increment('reply_count', 1);
    }
}