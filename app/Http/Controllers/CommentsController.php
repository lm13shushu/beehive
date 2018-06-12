<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Microblog;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    //评论存储
    //protected $type;
    //存储评论信息
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request,Microblog $microblog,Comment $comment)
    {
        //dd($microblog->id);
        $comment->microblog_id = $microblog->id;
        $comment->content = $request->content;
        $comment->from_uid = Auth::id();
        $comment->to_uid = $microblog->user->id;
        $comment->save();
        return  redirect()->route('microblogs.show',$microblog)->with('message', '回复成功！');  
    }

    public function storeReplies(Request $request,Microblog $microblog,Comment $replyObject){
        $reply = $replyObject->children()->create(['content' => $request->content,'from_uid' => Auth::id(),'to_uid' => $replyObject->from_uid]);
        return  redirect()->route('microblogs.show',$microblog)->with('message', '回复成功！');  
    }

    public function destroy(Comment $comment)
    {
        //dd('1');
        $this->authorize('destroy', $comment);
        $comment->delete();
        $mircoblog=$comment->microblog;
        return redirect()->route('microblogs.show',$mircoblog)->with('message', '删除成功！');
    }

}
