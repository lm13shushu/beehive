<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }


    //before方法会在策略中其他方法之前进行，提供全局授权
    public function before($user, $ability)
        {

            //如果用户有管理内容权限的话，即授权通过
            if ($user->can('manage_contents')) {
                return true;
            }

            // 返回值有三种 true 通过 false 拒绝 null 通过其他方法决定
            return ;
        }
}
