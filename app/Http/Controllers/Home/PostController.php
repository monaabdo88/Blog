<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Post;
class PostController extends Controller
{
    public function show(Post $post)
    {
       return view('website.post' , compact('post'));
    }
}
