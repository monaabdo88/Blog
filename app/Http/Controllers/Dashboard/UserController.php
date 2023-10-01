<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use \Illuminate\Support\Str;
use File;
use Yajra\DataTables\DataTables;
use App\Http\Trait\UploadImage;
class UserController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        
        return view('dashboard.users.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', $this->user);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->user);
        $data = [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'status'        => 'nullable|in:user,admin,writer',
            'email'         => 'required|email|unique:users',
            'phone'         => 'min:11|max:14|unique:users',
            'password'      => 'required|confirmed',
        ];
        $validatedData = $request->validate($data);
        /**upload avatar */
        if ($request->file('avatar')) {
            $filename = $this->upload($request->file('avatar'),'users');
            
        }else{
            $filename = 'no-img.png';
        }
        User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'gender'        => $request->gender,
            'about'         => $request->about,
            'avatar'        => $filename,
            'status'        => $request->status,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
        ]);
        session()->flash('success', __('site.added_successfully'));
            
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $this->user);
        return view('dashboard.users.edit', compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $this->user);
        $data = [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'status'        => 'nullable|in:user,admin,writer',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'phone'         => 'min:11|max:14|unique:users,phone,'.$user->id
        ];
        $validatedData = $request->validate($data);
        $data = $request->except(['password','_token','_method']);
        $user->update($data);
        //check & update password
        if($request->password)
        {
            $password = bcrypt($request->password);
            $user->update(['password'=> $password]);
        }
        //check & update avatar
        if ($request->file('avatar')) {
            if(File::exists(public_path('uploads/users/'.$user->avatar)) && $user->avatar !='no-img.png') {
                File::delete(public_path('uploads/users/'.$user->avatar));
            }
            $filename = $this->upload($request->file('avatar'),'users');
            $user->update(['avatar' => $filename]);
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
            
    }
    /**
     * Get all users
     * @return mixed
     */
    public function getAllUsers()
    {
        if (auth()->user()->can('viewAny', $this->user)) {
            $data = User::select('*');
        }else{
            $data = User::where('id' , auth()->user()->id);
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                if (auth()->user()->can('update', $row)) {
                    $btn .= '<a href="' . Route('dashboard.users.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> ';
                }
                if (auth()->user()->can('delete', $row)) {        
                    $btn .= '<a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->addColumn('avatar',function($row){
                return '<img src="'.asset('uploads/users/'.$row->avatar).'" width="100" class="img-thumbnail img-responsive"/>';                
            })
            ->addColumn('status', function ($row) {
                return $row->status == 'user' ? __('site.user') : __('site.' . $row->status);
            })
            ->rawColumns(['action', 'avatar','status'])
            ->make(true);
            
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', $this->user);
            $user = User::findOrFail($request->id);
            if($user->avatar !='no-img.png')
            {
                File::delete(public_path('uploads/users/'.$user->avatar));
            }   
            $user->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.users.index');
        
    }
}
