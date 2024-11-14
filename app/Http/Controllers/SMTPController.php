<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMTPModel;

class SMTPController extends Controller
{
    public function smtp_list(Request $request)
    {
        return view('admin.smtp.update');
    }
}
