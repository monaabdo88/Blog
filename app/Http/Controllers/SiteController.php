<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Main Page
     * return index view
     */
    public function index()
    {
        return view('site.index');
    }
}
