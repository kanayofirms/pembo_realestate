<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\RegisteredMail;
use Auth;
use Hash;
use Str;
use Mail;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $user = User::selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')->groupBy('month')->orderBy('month', 'asc')->get();

        $data['months'] = $user->pluck('month');
        $data['counts'] = $user->pluck('count');

        return view('admin.index', $data);
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

    public function users(Request $request)
    {
        $data['getRecord'] = User::getRecord($request);
        return view('admin.users.list', $data);
    }

    public function view($id)
    {
        $data['getRecord'] = User::find($id);
        return view('admin.users.view', $data);
    }

    public function edit($id)
    {
        $data['getRecord'] = User::find($id);
        return view('admin.users.edit', $data);
    }

    public function edit_post($id, Request $request)
    {
        $save = User::find($id);
        $save->name = trim($request->name);
        $save->username = trim($request->username);
        $save->phone = trim($request->phone);
        $save->role = trim($request->role);
        $save->status = trim($request->status);
        $save->save();

        return redirect('admin/users')->with('success', "Record Successfully Updated.");
    }

    public function admin_add_users(Request $request)
    {
        return view('admin.users.add');
    }

    public function admin_add_users_store(Request $request)
    {
        // dd($request->all());
        $user = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users',
            'role' => 'required',
            'status' => 'required'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);
        $user->role = trim($request->role);
        $user->status = trim($request->status);
        $user->remember_token = Str::random(50);
        $user->save();

        Mail::to($user->email)->send(new RegisteredMail($user));

        return redirect('admin/users')->with('success', "Record successfully added.");
    }

    public function set_new_password($token)
    {
        $data['token'] = $token;
        return view('auth.reset_password', $data);
    }

    public function set_new_password_post($token, ResetPassword $request)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->status = 'active';
        $user->save();

        return redirect('admin/login')->with('success', "New Password Successfully Set.");
    }

    public function admin_soft_delete($id, Request $request)
    {
        $softDelete = User::find($id);
        $softDelete->is_delete = 1;
        $softDelete->save();

        return redirect('admin/users')->with('success', "Record successfully soft deleted.");
    }
}
