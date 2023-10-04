<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category = $category->load('children');
        $posts = Post::where('category_id' , $category->id)->paginate(8);
        
        return view('site.category' , compact('category','posts'));
    }
}
