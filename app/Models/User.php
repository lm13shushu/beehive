<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//boot方法在用户模型类初始化之后进行加载，在其中添加监听方法
    public static function boot(){
        
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token =str_random(30);
        });

    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }
}
