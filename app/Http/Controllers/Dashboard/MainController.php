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
     * show site settings
     * @return array
     */
    public function show_settings()
    {
        $setting = Setting::first();
        return view('dashboard.settings',compact('setting'));
    }
    /**
     * Update Main Settings
     * @return void
     */
    public function update(Request $request , Setting $setting)
    {
       //validate Data
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
        /*session()->flash('success', __('site.updated_successfully'));*/
        return redirect()->route('dashboard.settings');
    }
}
