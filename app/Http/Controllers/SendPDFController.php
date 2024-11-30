<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendPDFController extends Controller
{
    public function send_pdf()
    {
        return view('admin.send_pdf.list');
    }
}
