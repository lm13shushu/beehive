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

    //路由中的{microblog}和方法中的变量$microblog匹配，通过类型提示在将依赖注入到方法中
    //可以通过$resquest提供的动态属性获取请求的值，例如$resquest->name
    public function show(Microblog $microblog,Request $request)
    {
        //dd($request->session()->all());
        if($microblog){
        //$categories =Category::all();
        $parentCommentIdsArray = [];
        $commentsList = [];
        $user = $microblog->user;
        $parentComments = $microblog->comments()
                                                     ->orderBy('created_at','desc')
                                                     ->paginate(10);
        foreach($parentComments as $k => $parentComment){
            $commentsList[$k]=$parentComment->getDescendantsAndSelf();
        }
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
    }else{
        return view('microblogs.microblog_not_exist');
        }
    }

    public function create()
    {
        //$categories =Category::all();
        $followers=Auth::user()->followers()->pluck('name')->toArray();
        $followings = Auth::user()->followings()->pluck('name')->toArray();
        //获取用户的关注和粉丝用户
        $atsArray = array_merge($followers, $followings);
        //删除重复值
        $ats=array_unique ($atsArray,SORT_STRING);
        return view('microblogs._createForm',['ats'=>$ats]);
    }
    
    //store() 方法的第二个参数，会创建一个空白的 $microblog 实例
    public function store(MicroblogRequest $request,Microblog $microblog)
    {
        //dd($request->at_user);
        // fill 方法会将传参的键值数组填充到模型的属性中
        $microblog->fill($request->all());
        if($request->category_id !== "1"){
            $microblog->category = Category::where('id',$request->category_id)->first()->name;
        }else{
            preg_match_all("/#([\s\S]*?)#/", $request->content, $matches);
            if(count($matches[0])>1||count($matches[0])==null){
                return redirect()->route('users.show',Auth::id())->with('danger', '发送微博失败，没填写话题或者话题不止一个！');
            }
           //dd($matches[1]);
            $categoryInstance=Category::where('name', $matches[1][0])->first();
            if(!$categoryInstance){
                    $category = new Category;
                    $category->name = $matches[1][0];
                    $category->save();
                    $categoryInstance=Category::where('name', $matches[1][0])->first();
                }

            //拼接categoryid存入微博实例中
             $microblog->category_id =  $categoryInstance->id;
             $microblog->category = $categoryInstance->name;
             $microblog->content = preg_replace("/#([\s\S]*?)#/","",$request->content);

        }
         $microblog->user_id = Auth::id();
         $microblog->at_user = $request->at_user;
         $microblog->save();

        return redirect()->route('home')->with('message', '发博成功！.');
    }

    public function destroy(Microblog $microblog)
    {
        $this->authorize('destroy', $microblog);
        $microblog->delete();

        return redirect()->route('users.show',Auth::id())->with('message', '删除成功！.');
    }

    public function like(Microblog $microblog){
         //Redis缓存中没有该微博,则从数据库中取值,并存入Redis中,该键值key='microblog:cache'.$id生命时间200s
        $post = Cache::remember('microblog:cache:'.$microblog->id, $this->cacheExpires, function () use ($microblog) {
            return $microblog;
        });
        //记录喜欢动作的用户id
        $user_id = Auth::id();
        //触发喜欢事件，查看用户是否已经喜欢过
        $result=event(new MicroblogLikeEvent($microblog->id,$user_id));
        if($result){
            $microblog->like_count += 1;
            $microblog->save();
            return $microblog->like_count;
        }
        return false;
    }

    //点击转发按钮
    public function showForwardMicroblog(Microblog $microblog){
        $user=$microblog->user;
        //查看微博有没有转发过
        if($microblog->is_forward == 0){
            return view('microblogs._forwardMicroblogInfo',compact('microblog', 'user'));
        }
    }

    //转发微博，传递被转发的微博到这个方法中
    public function forward(Microblog $microblog,Request $request){
        //新建一个微博模型
        $forwardMicroblog = new Microblog;
        $forwardMicroblog->content = $request->forward_content;
        $forwardMicroblog->user_id = Auth::id();
        $forwardMicroblog->category = $microblog->category;
        $forwardMicroblog->category_id = $microblog->category_id;
        $forwardMicroblog->is_forward = 1;
        $forwardMicroblog->initialMicroblog_Id = $microblog->id;
        $result = $forwardMicroblog->save();
        if($result){
            $microblog->forward_count++;
            $microblog->save();
        }
        return redirect()->route('home')->with('message', '转发成功！.');
    }

}