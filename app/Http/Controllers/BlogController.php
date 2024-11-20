<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function list_blog()
    {
        return view('admin.blog.list');
    }
}
