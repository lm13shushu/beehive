<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Microblog;

class MicroblogForwarded extends Notification
{
    use Queueable;

    public $microblog;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Microblog $microblog)
    {
        // 注入回复实体，方便 toDatabase 方法中的使用
        $this->microblog = $microblog;
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

    //使用数据库通知频道，定义toDatabase()方法
    //该方法返回一个数组，转化成json格式存储到通知数据表的data字段中
    public function toDatabase($notifiable){

        $forwardMicroblog_id = $this->microblog->id;
        $initialMicroblog_id = $this->microblog->initialMicroblog->id;
        $forwardMicroblog_link = getenv('APP_URL')."/microblogs/" .$forwardMicroblog_id;
        $initialMicroblog_link =  getenv('APP_URL')."/microblogs/". $initialMicroblog_id;
        //dd($this->parentComment);
        return[
            'forwardMicroblog_id' => $forwardMicroblog_id,
            'forwardMicroblog_content' => $this->microblog->content,
            'forwardMicroblog_user_id' =>$this->microblog->user_id,
            'forwardMicroblog_user_name' => $this->microblog->user->name,
            'forwardMicroblog_user_avatar' => $this->microblog->user->avatar,
            'forwardMicroblog_link' => $forwardMicroblog_link,
            'initialMicroblog_id' => $initialMicroblog_id, 
            'initialMicroblog_user_id' =>  $this->microblog->initialMicroblog->user_id,
            'initialMicroblog_content' => $this->microblog->initialMicroblog->content, 
            'initialMicroblog_link' => $initialMicroblog_link,
        ]; 
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
