<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }

    public function admin_profile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.admin_profile', $data);
    }

    public function update(Request $request)
    {
        $user = request()->validate([
            'email' => 'required|unique:users,email, ' . Auth::user()->id
        ]);
        $user = user::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if (!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }
        // $user->photo = trim($request->photo);
        $user->address = trim($request->address);
        $user->about = trim($request->about);
        $user->website = trim($request->website);
        $user->save();

        return redirect('admin/profile')->with('success', "Profile Updated Successfully!");
    }
}
