<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Comment;
use App\Models\Microblog;

class MicroblogReplied extends Notification
{
    use Queueable;

    public $comment;
    public $parentComment;
    public $microblog_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment,Microblog $microblog)
    {
        //注入回复实体，方便toDatabase方法中使用
        $this->comment = $comment;
        $this->parentComment = $comment->parent()->get();
        $this->microblog = $microblog;
       //$this->microblog_id = $comment->microblog_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //开启通知频道
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    //使用数据库通知频道，定义toDatabase()方法
    //该方法返回一个数组，转化成json格式存储到通知数据表的data字段中
    public function toDatabase($notifiable){
        // if($this->microblog_id==null){
        //     $this->microblog_id =$this->comment->getRoot()->microblog_id;
        // }
        $microblog_id = $this->microblog->id;
        // $microblog= $this->comment->getRoot()->microblog;
        $microblog_content =$this->microblog->content;
        $link = getenv('APP_URL')."/microblogs/".$microblog_id;
        //dd($this->parentComment);
        return[
            'comment_id' =>$this->comment->id,
            'comment_content' => $this->comment->content,
            'comment_user_id' =>$this->comment->from_uid,
            'comment_user_name' => $this->comment->user->name,
            'comment_user_avatar' => $this->comment->user->avatar,
            'to_user_id' =>  $this->comment->to_uid,
            'to_comment' => compact($this->parentComment), 
            'microblog_id' => $microblog_id, 
            'microblog_content' => $microblog_content,
            'link' => $link,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
