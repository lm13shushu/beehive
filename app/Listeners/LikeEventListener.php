<?php

namespace App\Listeners;

use App\Events\MicroblogLikeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
use App\Models\Microblog;


class LikeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MicroblogLikeEvent  $event
     * @return void
     */
    public function handle(MicroblogLikeEvent $event)
    {
        //
        $likeCacheKey='microblog:like:'.$event->microblog_id;
        //Redis命令SISMEMBER检查集合类型Set中有没有该键,Set集合类型中值都是唯一
        $existsInRedisSet = Redis::command('SISMEMBER', [$likeCacheKey, $event->user_id]);
        if(!$existsInRedisSet){
            //SADD,集合类型指令,向$likeCacheKey键中加一个值用户id
              Redis::command('SADD', [$likeCacheKey, $event->user_id]);
              return true;
        }
        return false;
    }
}
