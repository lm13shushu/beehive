<?php

namespace App\Http\Controllers;

use App\Models\Microblog;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MicroblogRequest;
use Illuminate\Support\Facades\Redis;
use App\Events\MicroblogViewEvent;
use App\Events\MicroblogLikeEvent;
use Cache;
use Auth;


class MicroblogsController extends Controller
{
    public $cacheExpires=200;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    //展示个人所发的微博
    public function showPerson(User $user)
    {
        $microblogs = $user->microblogs()
                                     ->orderBy('created_at','desc')
                                     ->paginate(10);
        return view('microblogs._microblog', compact('user','microblogs'));
    }

    public function show(Microblog $microblog,Request $request)
    {
        //$categories =Category::all();
        $commentsList = [];
        $user = $microblog->User;
        $comments = $microblog->comments()
                                            ->orderBy('created_at','desc')
                                            ->paginate(10);
        foreach($comments as $k => $comment){
            $commentsList[$k]=$comment->getDescendantsAndSelf();
        }
        //dd($commentsList);
        //Redis缓存中没有该微博,则从数据库中取值,并存入Redis中,该键值key='microblog:cache'.$id生命时间300s
        $post = Cache::remember('microblog:cache:'.$microblog->id, $this->cacheExpires, function () use ($microblog) {
            return $microblog;
        });

        //dd(Redis::get('beehive_cache:microblog:cache:'.$microblog->id));
        //获取客户端请求的IP
        $ip = $request->ip();

        //触发浏览次数统计时间
        event(new MicroblogViewEvent($microblog->id, $ip)); 

        return view('microblogs.show', compact('microblog','user','commentsList'));
    }

    public function create()
    {
        //$categories =Category::all();
        return view('microblogs._createForm');
    }
    
    //store() 方法的第二个参数，会创建一个空白的 $topic 实例
    public function store(MicroblogRequest $request,Microblog $microblog)
    {
        // fill 方法会将传参的键值数组填充到模型的属性中
        $microblog->fill($request->all());
        $microblog->user_id =Auth::id();
        $microblog->category = Category::where('id',$request->category_id)->first()->name;
        $microblog->save();
        return redirect()->route('home')->with('message', 'Created successfully.');
    }

    public function destroy(Microblog $microblog)
    {
        $this->authorize('destroy', $microblog);
        $microblog->delete();

        return redirect()->route('users.show',Auth::id())->with('message', 'Deleted successfully.');
    }

    public function like(Microblog $microblog){
         //Redis缓存中没有该微博,则从数据库中取值,并存入Redis中,该键值key='microblog:cache'.$id生命时间300s
        $post = Cache::remember('microblog:cache:'.$microblog->id, $this->cacheExpires, function () use ($microblog) {
            return $microblog;
        });
        //记录喜欢动作的用户id
        $user_id = Auth::id();
        //触发喜欢活动，查看用户是否已经喜欢过
        $result=event(new MicroblogLikeEvent($microblog->id,$user_id));
        if($result){
            $microblog->like_count += 1;
            $microblog->save();
            return $microblog->like_count;
        }
        return false;
    }
}