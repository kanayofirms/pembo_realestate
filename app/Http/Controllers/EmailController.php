<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ComposeEmailModel;
use App\Mail\ComposeEmailMail;
use Mail;

class EmailController extends Controller
{
    public function email_compose()
    {
        // $data['getEmail'] = User::where('role', '=', array(['agent', 'user']))->get();
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->get();
        return view('admin.email.compose', $data);
    }

    public function email_post(Request $request)
    {
        // dd($request->all());
        $save = new ComposeEmailModel;
        $save->user_id = $request->user_id;
        $save->cc_email = trim($request->cc_email);
        $save->subject = trim($request->subject);
        $save->descriptions = trim($request->descriptions);
        $save->save();

        //Email Start
        $getUserEmail = User::where('id', '=', $request->user_id)->first();

        Mail::to($getUserEmail->email)->cc($request->cc_email)->send(new ComposeEmailMail($save));
        //Email End

        return redirect('admin/email/compose')->with('success', "Email Successfully Sent!");
    }

    public function email_sent(Request $request)
    {
        $data['getRecord'] = ComposeEmailModel::get();
        return view('admin.email.send', $data);
    }


    public function email_sent_delete(Request $request)
    {
        if (!empty($request->id)) {
            $option = explode(',', $request->id);
            foreach ($option as $id) {
                if (!empty($id)) {
                    $getRecord = ComposeEmailModel::find($id);
                    $getRecord->delete();
                }
            }
        }

        return redirect()->back()->with('success', "Sent Email Successfully Deleted.");
    }

    public function email_read($id, Request $request)
    {
        $data['getRecord'] = ComposeEmailModel::find($id);
        return view('admin.email.read', $data);
    }

    public function email_read_delete($id, Request $request)
    {
        $deleteRecord = ComposeEmailModel::find($id);
        $deleteRecord->delete();

        return redirect('admin/email/sent')->with('success', "Sent Email Successfully Deleted!");
    }
}

