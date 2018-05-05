<?php

namespace App\Http\Controllers;

use App\Models\Microblog;
use App\Models\User;
use App\Models\Category;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MicroblogRequest;
use Auth;


class MicroblogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    //展示个人所发的微博
    public function showPerson(User $user)
    {
        $microblogs = $user->microblogs()
                                     ->orderBy('created_at','desc')
                                     ->paginate(20);
        return view('microblogs._microblog', compact('user','microblogs'));
    }

    public function show(Microblog $microblog)
    {
        //$categories =Category::all();
        $commentsList = [];
        $user = $microblog->User;
        $comments = $microblog->comments()
                                            ->orderBy('created_at','desc')
                                            ->with('user')
                                            ->paginate(10);
        foreach($comments as $k => $comment){
            $commentsList[$k]=$comment->getDescendantsAndSelf();
        }
        //dd($commentsList);
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
        $microblog ->save();
        return redirect()->route('home')->with('message', 'Created successfully.');
    }

    public function destroy(Microblog $microblog)
    {
        $this->authorize('destroy', $microblog);
        $microblog->delete();

        return redirect()->route('microblogs.index')->with('message', 'Deleted successfully.');
    }
}