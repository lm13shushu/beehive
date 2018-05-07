<?php

namespace App\Listeners;

use App\Events\MicroblogViewEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
use App\Models\Microblog;

class MicroblogEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    //一个帖子的最大访问数
    const microblogViewLimit = 2;
    //同一用户浏览同一帖子的过期时间
    const isExpireSec = 200;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MicroblogViewEvent  $event
     * @return void
     */
    public function handle(MicroblogViewEvent $event)
    {
        //
        $id = $event->id;
        $ip = $event->ip;
        //首先判断下ipExpireSec = 200秒时间内,同一IP访问多次,仅仅作为1次访问量
         if($this->ipViewLimit($id, $ip)){
              //一个IP在200秒时间内访问第一次时,刷新下该篇微博的浏览量
              $this->updateCacheViewCount($id);
       }
    }
        //限制同一IP一段时间内得访问,防止增加无效浏览次数
        public function ipViewLimit($id, $ip)
         {
             $ipMicroblogViewKey = 'microblog:ip:limit:'.$id;
             //Redis命令SISMEMBER检查集合类型Set中有没有该键,Set集合类型中值都是唯一
             $existsInRedisSet = Redis::command('SISMEMBER', [$ipMicroblogViewKey, $ip]);
             //如果集合中不存在这个建 那么新建一个并设置过期时间
             if(!$existsInRedisSet){
              //SADD,集合类型指令,向ipMicroblogViewKey键中加一个值ip
              Redis::command('SADD', [$ipMicroblogViewKey, $ip]);
              //并给该键设置生命时间,这里设置200秒,200秒后同一IP访问就当做是新的浏览量了
              Redis::command('EXPIRE', [$ipMicroblogViewKey, self::isExpireSec]);
              return true;
         }
        return false;
    }

    //达到要求更新数据库的浏览量
    public function updateModelViewCount($id, $count)
    {
        //访问量达到上限时,再进行一次SQL更新
        //字符串反序列化为对象
        $microblog=unserialize(Redis::get('beehive_cache:microblog:cache:'.$id));
        $microblog->view_count += $count;
        $microblog->save();
    }

     //不同用户访问,更新缓存中浏览次数
    public function updateCacheViewCount($id)
    {
        $cacheKey = 'microblog:view:'.$id;
        //这里以Redis哈希类型存储键,就和数组类似,$cacheKey就类似数组名 如果这个key存在
        if(Redis::command('HEXISTS', [$cacheKey, 'view_count'])){
            //哈希类型指令HINCRBY,就是给$cacheKey[$ip]加上一个值,这里一次访问就是1
            $save_count = Redis::command('HINCRBY', [$cacheKey, 'view_count', 1]);
            //redis中这个存储浏览量的值达到次数后,就去刷新一次数据库
            if($save_count >= self::microblogViewLimit){
                $this->updateModelViewCount($id, $save_count);
                //redis中浏览量刷进MySQL后,就把该篇微博的浏览量清空,重新开始计数
                Redis::command('HDEL', [$cacheKey, 'view_count']);
                Redis::command('DEL', ['beehive_cache:microblog:cache:'.$id]);
            }
        }else{
        //哈希类型指令HSET,和数组类似,就像$cacheKey[$ip] = 1;
        Redis::command('HSET', [$cacheKey,'view_count', '1']);
        }
    }

}
