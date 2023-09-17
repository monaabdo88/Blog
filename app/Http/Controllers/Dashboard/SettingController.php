<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use \Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.settings',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $data = [
            'logo'          => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon'       => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'facebook'      => 'nullable|string',
            'twitter'       => 'nullable|string',
            'site_phone'    => 'nullable|string',
            'site_mail'     => 'nullable|email',
            ];
            //validate data for lang
            foreach (config('app.languages') as $key => $value) {
                $data[$key . '*.site_name']         = 'nullable|string';
                $data[$key . '*.site_desc']         = 'nullable|string';
                $data[$key . '*.site_keywords']     = 'nullable|string';
                $data[$key . '*.site_copyrights']   = 'nullable|string';
                $data[$key . '*.site_about']        = 'nullable|string';
                $data[$key . '*.site_close_msg']    = 'nullable|string';
            }
            $validatedData = $request->validate($data);
            //update settings data
            $setting->update($request->except('logo', 'favicon', '_token','_method'));
    
            //upload Site Logo
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = Str::uuid() . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $path = 'uploads/site/' . $filename;
                $setting->update(['logo' => $path]);
            }
            //upload site favicon
            if ($request->file('favicon')) {
                $file = $request->file('favicon');
                $filename = Str::uuid() . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $path = 'uploads/site/' . $filename;
                $setting->update(['favicon' => $path]);
            }
            //redirect after update to the main route
            session()->flash('success', __('site.updated_successfully'));
            return redirect()->route('dashboard.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
