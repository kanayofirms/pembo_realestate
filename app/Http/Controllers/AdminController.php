<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResetPassword;
use App\Models\User;
use App\Models\ComposeEmailModel;
use App\Mail\RegisteredMail;
use Auth;
use Hash;
use Str;
use Mail;

class AdminController extends Controller
{

    public function typeahead_autocomplete(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->get('query');
        $filter_data = User::where('name', 'LIKE', '%' . $query . '%')
            ->pluck('name'); // This returns only the names, reducing overhead

        return response()->json($filter_data);
    }
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

    public function admin_users(Request $request)
    {
        $data['getRecord'] = User::getRecord($request);
        $data['TotalAdmin'] = User::where('role', '=', 'admin')->where('is_delete', '=', 0)->count();
        $data['TotalAgent'] = User::where('role', '=', 'agent')->where('is_delete', '=', 0)->count();
        $data['TotalUser'] = User::where('role', '=', 'user')->where('is_delete', '=', 0)->count();
        $data['TotalActive'] = User::where('status', '=', 'active')->where('is_delete', '=', 0)->count();
        $data['TotalInActive'] = User::where('status', '=', 'inactive')->where('is_delete', '=', 0)->count();
        $data['Total'] = User::where('is_delete', '=', 0)->count();
        return view('admin.users.list', $data);
    }

    public function view_users($id)
    {
        $data['getRecord'] = User::find($id);
        return view('admin.users.view', $data);
    }

    public function edit_users($id)
    {
        $data['getRecord'] = User::find($id);
        return view('admin.users.edit', $data);
    }

    public function edit_users_update($id, Request $request)
    {
        $save = User::find($id);
        $save->name = trim($request->name);
        $save->username = trim($request->username);
        $save->phone = trim($request->phone);
        $save->role = trim($request->role);
        $save->status = trim($request->status);

        if (!empty($request->file('photo'))) {
            if (!empty($save->photo) && file_exists('upload/' . $save->photo)) {
                unlink('upload/' . $save->photo);
            }
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $save->photo = $filename;
        }

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

        if (!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }
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

    public function admin_users_update(Request $request)
    {
        $getRecord = User::find($request->input('edit_id'));
        $getRecord->name = $request->input('edit_name');
        $getRecord->save();
        $json['success'] = 'Data Updated Successfully';
        echo json_encode($json);
    }

    public function admin_users_changeStatus(Request $request)
    {
        $order = User::find($request->order_id);
        $order->status = $request->status_id;
        $order->save();
        $json['success'] = true;
        echo json_encode($json);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $isExists = User::where('email', '=', $email)->first();

        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));

        }
    }

    public function my_profile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.profile', $data);
    }

    public function my_profile_update(Request $request)
    {
        // dd($request->all());
        $user = request()->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if (!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect('admin/my_profile')->with('success', "My Account Successfully Updated.");
    }

    public function agent_email_inbox(Request $request)
    {
        $data['getRecord'] = ComposeEmailModel::getAgentRecord(Auth::user()->id);
        return view('agent.email.inbox', $data);
    }
}
