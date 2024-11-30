<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendPDFMail;
use Mail;

class SendPDFController extends Controller
{
    public function send_pdf()
    {
        return view('admin.send_pdf.list');
    }

    public function send_pdf_sent(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'doc_file' => 'required|file|mimes:pdf|max:2048',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        try {
            $file = $request->file('doc_file');
            $filePath = $file->store('documents');
            $fileUrl = asset('storage/app/' . $filePath);

            Mail::to($request->email)->send(new SendPDFMail($request, $filePath, $fileUrl));
        } catch (\Exception $e) {

        }

        return redirect('admin/send_pdf')->with('success', "Document Successfully Sent!");
    }
}
