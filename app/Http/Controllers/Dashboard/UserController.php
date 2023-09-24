<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use \Illuminate\Support\Str;
use File;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('dashboard.users.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->authorize('update', $this->user);
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
            
            $file = $request->file('avatar');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('uploads/users/'), $filename);
            //$path = 'uploads/users/' . $filename;
            
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
        session()->flash('success', __('users.added_successfully'));
            
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
        if($user->id != 1)
            return view('dashboard.users.edit', compact('user'));
        else
            return redirect()->route('dashboard.users.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
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
            $file = $request->file('avatar');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('uploads/users/'), $filename);
            //$path = 'uploads/users/' . $filename;
            $user->update(['avatar' => $filename]);
        }
        session()->flash('success', __('users.updated_successfully'));
        return redirect()->route('dashboard.users.index');
            
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
                if($row->id != 1){
                    $btn .= '<a href="' . Route('dashboard.users.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> ';
                    $btn .= '<a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->addColumn('status', function ($row) {
                return $row->status == 'user' ? __('site.user') : __('site.' . $row->status);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
            
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->id != 1){
            $user = User::findOrFail($request->id);
            if($user->avatar !='no-img.png')
            {
                File::delete(public_path('uploads/users/'.$user->avatar));
            }   
            $user->delete();
            session()->flash('success', __('users.deleted_successfully'));
            return redirect()->route('dashboard.users.index');
        }
        else{
            return redirect()->route('dashboard.users.index');   
        }
    }
}
