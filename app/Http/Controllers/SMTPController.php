<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMTPModel;

class SMTPController extends Controller
{
    public function smtp_list(Request $request)
    {
        $data['getRecord'] = SMTPModel::getSingleFirst();
        return view('admin.smtp.update', $data);
    }

    public function smtp_update(Request $request)
    {
        dd($request->all());
    }
}
