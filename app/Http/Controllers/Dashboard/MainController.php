<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Setting;
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
        $settings = Setting::first();
        return view('dashboard.settings',compact('settings'));
    }
    /**
     * Update Main Settings
     * @return void
     */
    public function updateSettings(Request $request , Setting $setting)
    {
        $data = $request->all();
        Setting::where('id',1)->update($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.settings');
    }
}
