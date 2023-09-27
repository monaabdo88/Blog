<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use File;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->orWhere('parent_id',0)->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category =  Category::create($request->except('thumbnail', '_token'));
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $filename);
            $path = 'uploads/categories/' . $filename;
            $category->update(['thumbnail' => $filename]);
        }
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->orWhere('parent_id',0)->get();
        return view('dashboard.categories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->except('thumbnail', '_token','_method'));
        //update category thumbnail code
        if ($request->file('thumbnail')) {
            //delete the prev thumbnail
            if($category->thumbnail != 'no-thumb.png')
                File::delete(public_path('uploads/categories/'.$category->thumbnail));
    
            //upload & update the new thumbnail
            $file = $request->file('thumbnail');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories/'), $filename);
            

            $category->update(['thumbnail' => $filename]);
        }
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if (is_numeric($request->id)) {
            $cat_parent = Category::where('parent_id', $request->id)->first();
            //delete category thumbnail
            if($category->thumbnail != 'no-thumb.png' || $cat_parent->thumbnail != 'no-thumb.png')
            {
                File::delete(public_path('uploads/categories/'.$category->thumbnail));
                File::delete(public_path('uploads/categories/'.$cat_parent->thumbnail));
            }
            //delete categories parent & childes
            $cat_parent->delete();
            $category->delete();
            
        }
        return redirect()->route('dashboard.categories.index');

    }
    /**
     * Get all Categories
     * @return mixed
     */
    public function getAllCats()
    {
        $data = Category::select('*')->with('parents');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> ';
                $btn .= '<a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('parent', function ($row) {
                return ($row->parent_id ==  0) ? trans('site.main_category') :   $row->parents->translate(app()->getLocale())->title;
            })
            
            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('thumbnail',function($row){
                return '<img src="'.asset('uploads/categories/'.$row->thumbnail).'" width="100" class="img-thumbnail img-responsive"/>';                
            })
            ->addColumn('status', function ($row) {
                return $row->status == 0 ? __('site.not_active') : __('site.active');
            })
            ->rawColumns(['action', 'status', 'parent','title','thumbnail'])
            ->make(true); 
    }
}
