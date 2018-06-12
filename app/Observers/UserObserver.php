<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Microblog;
use App\Models\Comment;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function deleting(User $user)
    {
        //当后台删除用户时，将用户所发微博一并删除
        $microblogsIdList= [];
        $microblogsIdList=$user->microblogs->pluck('id')->toArray();
        $result = Microblog::destroy($microblogsIdList);
        if($result){
            Comment::where("from_uid",$user->id)->orWhere('to_uid',$user->id)->delete();
        }
    }
}