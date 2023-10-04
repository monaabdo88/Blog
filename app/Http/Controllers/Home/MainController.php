<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class MainController extends Controller
{
    public function index()
    {
        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->limit(5);
        }])->get();
       return view('site.index' , compact('categories_with_posts'));
    }
}
