<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Microblog;

class SearchController extends Controller
{
    //
    public $paginator = ['user'=>'','microblog'=>''];

    public function microblogSearch(Request $request)
    {
        $query = $request->get('query');
        if ($query) {
            $this->paginator['microblog']= Microblog::search($query)->paginate(15);
        }

        return view('search.searchMicroblogs',  ['paginator'=>$this->paginator,'query' =>$query] );
    }

     public function userSearch(Request $request)
    {
        $query = $request->get('query');
        if ($query) {
            $this->paginator['user'] = User::search($query)->paginate(10);
        }

        return view('search.searchUsers', ['paginator'=>$this->paginator,'query' =>$query] );
    }
}
