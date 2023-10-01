<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use File;
use Yajra\DataTables\DataTables;
use App\Http\Trait\UploadImage;
use App\Models\User;
class PostController extends Controller
{
    use UploadImage;
    protected $postmodel;

    public function __construct(Post $post) {
        $this->postmodel = $post;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::all();
        $users = User::all();
        if (count($categories)>0) {
            return view('dashboard.posts.create' , compact('categories','users'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' , $this->postmodel);
        $post =  Post::create($request->except('main_img', '_token'));
        if ($request->file('main_img')) {
            $filename = $this->upload($request->file('main_img'),'posts');
            $post->update(['main_img' => $filename]);
        }
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update' , $post);
        $categories = Category::all();
        $users = User::all();
        return view('dashboard.posts.edit' , compact('post','categories','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update' , $post);
        $post->update($request->except('main_img', '_token','_method'));
        //update category main_img code
        if ($request->file('main_img')) {
            //delete the prev main_img
            if(isset($post->main_img))
                File::delete(public_path('uploads/posts/'.$post->main_img));
    
            //upload & update the new main_img
            $filename = $this->upload($request->file('main_img'),'posts');
            $post->update(['main_img' => $filename]);
        }
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete' , $post);
        Post::where('id' , $request->id)->delete();
        if(isset($post->main_img))
        {
            File::delete(public_path('uploads/posts/'.$post->main_img));
        }

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.posts.index');

    }
    /**
     * get all posts
     * @return array
     */
    public function getAllPosts()
    {

        $data = Post::select('*')->with('category');
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if(auth()->user()->can('update', $row)){
                    return $btn = '
                        <a href="' . Route('dashboard.posts.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
            })
            ->addColumn('category_name', function ($row) {
                if(count(Category::all()) > 0)
                    return  $row->category->translate(app()->getLocale())->title;
                else
                    return '';
            })
            ->addColumn('user', function ($row) {
                return  $row->user->first_name . ' '.$row->user->last_name;
            })
            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('main_img',function($row){
                return '<img src="'.asset('uploads/posts/'.$row->main_img).'" width="100" class="img-main_img img-responsive"/>';                
            })
            ->addColumn('status', function ($row) {
                return $row->status == 0 ? __('site.not_active') : __('site.active');
            })
            ->rawColumns(['action', 'title' ,'user','status','main_img', 'category_name'])
            ->make(true);
    }
}
