<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    //middleware 方法，该方法接收两个参数，第一个为中间件的名称，第二个为要进行过滤的动作。
    public function __construct(){
        $this->middleware('auth',['except'=>['show']]);
    }

    public function show(User $user){
        $categories = Category::all();
        return view('users.show',compact('user','categories'));
    }
    
    public function edit(User $user){

        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
         $this->authorize('update', $user);
        //dd($request->avatar);
        $data = $request->all();
        if($request->avatar){
            $result = $uploader->save($request->avatar,'avatars',$user->id);
            //注意 if ($result) 的判断是因为 ImageUploadHandler 对文件后缀名做了限定，不允许的情况下将返回 false
            if($result){
                $data['avatar'] = $result['path'];
            }
        }
        // dd($data);
        
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
