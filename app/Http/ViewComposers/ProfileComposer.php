<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;
use App\Models\Category;

class ProfileComposer
{
    /**
     * 用户仓库实现.
     *
     * @var UserRepository
     */
   //protected $users;
    protected $categories;

    /**
     * 创建一个新的属性composer.
     *
     * @param UserRepository $users
     * @return void
     */
    public function __construct(Category $category)
    {
        // Dependencies automatically resolved by service container...
        //$this->users = $users;
        $this->categories = $category->get();
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories',compact($this->categories));
    }
}
