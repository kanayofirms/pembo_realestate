<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function notification_index(Request $request)
    {
        $data['getRecord'] = User::get();
        return view('admin.notification.update', $data);
    }
}
