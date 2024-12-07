<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SupportModel;
use App\Models\SupportReplyModel;

class SupportController extends Controller
{
    public function support(Request $request)
    {
        $getRecord = SupportModel::getSupportList($request);
        $data['user'] = $getRecord;
        $data['getUser'] = User::get();
        return view('admin.support.list', $data);
    }

    public function reply($id)
    {
        $getRecord = SupportModel::find($id); // Simplified to fetch the record by ID.
        if (!$getRecord) {
            abort(404, 'Support record not found.');
        }

        $data['edit'] = $getRecord;
        return view('admin.support.reply', $data);
    }

    public function change_support_status(Request $request)
    {
        $record = SupportModel::find($request->id);
        $record->status = $request->status;
        $record->save();

        $json['success'] = true;
        echo json_encode($json);
    }

}
