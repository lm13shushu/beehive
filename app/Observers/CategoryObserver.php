<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Microblog;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CategoryObserver
{
     public function deleting(Category $category)
    {
       $microblogsIdList = [];
       $microblogsIdList = $category->microblogs->pluck('id')->toArray();
       Microblog::destroy($microblogsIdList);
    }

}