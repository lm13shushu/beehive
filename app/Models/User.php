<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Scout\Searchable;
use Auth;

class User extends Authenticatable
{
    use Notifiable{
        //将原方法改名
        notify as protected laravelNotify;
    }
    //生成活跃用户
    use Traits\ActiveUserHelper;
    //记录用户最后的登陆时间
    use Traits\LastActivedAtHelper;
    //使用laravel-permission提供的trait HasRoles
    use HasRoles;
    //使用搜索插件提供的trait
    use Searchable;

    //主键
    protected $pk = 'id';
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

        //创建激活码
        static::creating(function ($user) {
            $user->activation_token =str_random(30);
        });

    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }

    public function microblogs(){
        return $this->hasMany(Microblog::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Eloquent 关联的 预加载 with 方法，预加载避免了 N+1 查找的问题，提高查询效率
    //可以简单理解为 followings 返回的是数据集合，而 followings() 返回的是数据库查询语句
    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids,Auth::user()->id);
        return Microblog::whereIn('user_id',$user_ids)
                                        ->with('user')
                                        ->orderBy('created_at','desc');
    }

    //获取粉丝列表
    public function followers()
    {
        //在多对多关系中，会新建一张表来存放多对多关系的数据，把表名改为followers
        //user_id作为关联关系的外键，follower_id作为连接到的模型的外键名称。
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //获取用户关注人列表
     public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    //关注
    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        //Sync方法接收两个参数，第一个参数是要添加的id，第二个参数是是否移除之前的关联id
         $this->followings()->sync($user_ids, false);
         return true;

    }

    //取消关注
    public function unfollow($user_ids)
    {
        //detach方法接受数组
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    //查看是否已经关注过此人
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }    

     public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    //模型修改器，当给属性赋值时，修改器自动调用
    public function setPasswordAttribute($value)
    {
         // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

     public function setAvatarAttribute($path)
    {
        // 如果不是 'http' 开头，那就是从后台上传的，需要补全 URL
        if ( ! starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }
    
    //定义要查询的字段
    public function toSearchableArray()
    {
        return [
            'user_name' => $this->name,
            'user_email' => $this->email,
        ];
    }

    //定义索引里的type值
    public function searchableAs()
    {
        return 'user';
    }
}
