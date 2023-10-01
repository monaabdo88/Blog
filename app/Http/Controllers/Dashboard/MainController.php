<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\models\Post;
use App\Models\User;
use App\Models\Setting;
use \Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
class MainController extends Controller
{
    /**
     * Main Function
     * @return dashboard view
     */
    public function index()
    {
        $categories_count = Category::count();
        $posts_count = Post::count();
        $users_count = User::count();
        return view('dashboard.index',compact('categories_count','posts_count','users_count'));
    }
    
    
}
