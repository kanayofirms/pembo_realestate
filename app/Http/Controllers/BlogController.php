<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function list_blog()
    {
        $data['getRecord'] = BlogModel::getAllRecord();
        return view('admin.blog.list', $data);
    }

    public function add_blog(Request $request)
    {
        return view('admin.blog.add');
    }

    public function store_blog(Request $request)
    {
        // dd($request->all());
        $save = request()->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        $save = new BlogModel;
        $save->title = trim($request->title);
        $save->slug = trim($request->slug);
        $save->description = trim($request->description);
        $save->save();

        return redirect('admin/blog')->with('success', 'Blog Successfully Added');
    }

    public function edit_blog($id, Request $request)
    {
        $data['getRecord'] = BlogModel::find($id);
        return view('admin.blog.edit', $data);
    }

    public function view_blog($id)
    {
        $data['getRecord'] = BlogModel::find($id);
        return view('admin.blog.view', $data);
    }

    public function delete_blog($id)
    {
        $recordDelete = BlogModel::find($id);
        $recordDelete->delete();

        return redirect('admin/blog')->with('success', "Record Successfully Deleted!");
    }
}
