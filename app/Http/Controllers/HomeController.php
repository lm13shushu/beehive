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
        if(Auth::check()){
            $feed_items = Auth::user()->feed()->paginate(20);
            $active_users = Auth::user()->getActiveUsers();
        }
        //dd($active_users);
        return view('pages.root',compact('feed_items','active_users'));
    }
}
