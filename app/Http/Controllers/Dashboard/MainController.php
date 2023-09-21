<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\models\Post;
use App\Models\User;
use App\Models\Tag;
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
        $tags_count = Tag::count();
        return view('dashboard.index',compact('categories_count','posts_count','users_count','tags_count'));
    }
    
   /**
     * Get all users
     * @return mixed
     */
    public function getAllUsers()
    {
        $data = User::select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . Route('dashboard.users.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> ';
                $btn .= '<a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                
                return $btn;
            })
            ->addColumn('status', function ($row) {
                return $row->status == 'user' ? __('site.user') : __('site.' . $row->status);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
            
    }
}
