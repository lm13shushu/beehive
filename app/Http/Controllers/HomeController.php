<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Category;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //将中间件分配给该控制器
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed_items = [];
        if(Auth::check()&&count(Auth::user()->followings)>0){
            //获取动态流
            $feed_items = Auth::user()->feed()->paginate(15);

            $active_users = Auth::user()->getActiveUsers();

            return view('pages.root',compact('feed_items','active_users'));
        }else{
            return redirect()->route('home.followUsers');
        }
        //dd($active_users);
    } 

    //用户在注册完毕没有关注用户的时候，展示关注表单
    public function followUsers()
    {
        if(Auth::check()&&count(Auth::user()->followings)==0){

            $active_users = Auth::user()->getActiveUsers();

            return view('pages.followUsers',compact('active_users'));
        }else{

            return redirect()->route('home');

        }  
    }
}
