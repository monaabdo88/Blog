<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use \Illuminate\Support\Str;
use File;
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
        return view('dashboard.users.edit', compact('user'));
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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        if($user->avatar !='no-img.png')
        {
            File::delete(public_path('uploads/users/'.$user->avatar));
        }   
        $user->delete();
        session()->flash('success', __('users.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
