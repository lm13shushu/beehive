<?php

namespace App\Models\Traits;

use App\Models\Microblog;
use App\Models\Comment;
use Carbon\Carbon;
use Cache;
use DB;

trait ActiveUserHelper
{
    // 用于存放临时用户数据
    protected $users = [];       

    // 配置信息
    protected $microblog_weight = 4; // 微博权重
    protected $comment_weight = 1; // 回复权重
    protected $pass_days = 7;    // 多少天内发表过内容
    protected $user_number = 10; // 取出来多少用户

    // 缓存相关配置
    protected $cache_key = 'beehive_active_users';
    protected $cache_expire_in_minutes = 60;

    public function getActiveUsers()
    {
        // 尝试从缓存中取出 cache_key 对应的数据。如果能取到，便直接返回数据。
        // 否则运行匿名函数中的代码来取出活跃用户数据，返回的同时做了缓存。
        return Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function(){
            return $this->calculateActiveUsers();
        });
    }

    public function calculateAndCacheActiveUsers()
    {
        // 取得活跃用户列表
        $active_users = $this->calculateActiveUsers();
        // 并加以缓存
        $this->cacheActiveUsers($active_users);
    }

    private function calculateActiveUsers()
    {
        $this->calculateMicroblogScore();
        $this->calculateCommentScore();

        // 数组按照得分排序
        $users = array_sort($this->users, function ($user) {
            return $user['score'];
        });

        // 倒序排列，高分靠前，第二个参数为保持数组的 KEY 不变
        $users = array_reverse($users, true);

        // 只获取想要的数量
        $users = array_slice($users, 0, $this->user_number, true);

        // 新建一个空集合
        $active_users = collect();

        foreach ($users as $user_id => $user) {
            // 找寻下是否可以找到用户
            $user = $this->find($user_id);

            // 如果数据库里有该用户的话
            if ($user) {

                // 将此用户实体放入集合的末尾
                $active_users->push($user);
            }
        }

        // 返回数据
        return $active_users;
    }

    private function calculateMicroblogScore()
    {
        // 从微博数据表里取出限定时间范围内，有发表过微博的用户
        // 并且同时取出用户此段时间内发布微博的数量，DB::raw使用sql原生表达式
        $microblog_users = Microblog::query()->select(DB::raw('user_id, count(*) as microblog_count'))
                                     ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                                     ->groupBy('user_id')
                                     ->get();
        // 根据话题数量计算得分
        foreach ($microblog_users as $value) {
            $this->users[$value->user_id]['score'] = $value->microblog_count * $this->microblog_weight;
        }
    }

    private function calculateCommentScore()
    {
        // 从回复数据表里取出限定时间范围内，有发表过回复的用户
        // 并且同时取出用户此段时间内发布回复的数量
        $comment_users = Comment::query()->select(DB::raw('from_uid, count(*) as comment_count'))
                                     ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                                     ->groupBy('from_uid')
                                     ->get();
        // 根据回复数量计算得分
        foreach ($comment_users as $value) {
            $comment_score = $value->comment_count * $this->comment_weight;
            if (isset($this->users[$value->user_id])) {
                $this->users[$value->user_id]['score'] += $comment_score;
            } else {
                $this->users[$value->user_id]['score'] = $comment_score;
            }
        }
    }

    private function cacheActiveUsers($active_users)
    {
        // 将数据放入缓存中
        Cache::put($this->cache_key, $active_users, $this->cache_expire_in_minutes);
    }
}