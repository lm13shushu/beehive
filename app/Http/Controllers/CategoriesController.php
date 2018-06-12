<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function show(Category $category){

        $microblogs = $category->microblogs()->paginate(10);
        $category = $category->name;

        return view('microblogs.microblogInCategory',compact('microblogs','category'));
    }
}
