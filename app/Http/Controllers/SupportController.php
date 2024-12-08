<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SupportModel;
use App\Models\SupportReplyModel;
use Auth;
use DB;

class SupportController extends Controller
{
    public function delete_multi_item(Request $request)
    {
        if (!empty($request->id)) {
            $option = explode(',', $request->id);
            foreach ($option as $id) {
                if (!empty($id)) {
                    $getrecord = SupportModel::find($id);
                    $getrecord->delete();
                }
            }
        }
        return redirect()->back()->with('success', 'Selected records have been successfully deleted.');
    }

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

    public function reply_store(Request $request, $id)
    {
        $getRecord = new SupportReplyModel;
        $getRecord->user_id = Auth::user()->id;
        $getRecord->support_id = $request->id;
        $getRecord->description = $request->description;

        $getRecord->save();

        return redirect('admin/support/reply/' . $id)
            ->with('success', 'Support ticket has been successfully updated. You can now review the changes.');

    }

    public function status_update($id, Request $request)
    {
        $product = DB::table('support')->select('status')->where('id', '=', $id)->first();

        if ($product) {
            $status = $product->status == '1' ? '0' : '1';

            DB::table('support')->where('id', $id)->update(['status' => $status]);

            return redirect()->back()->with('success', 'Support ticket status updated successfully.');
        }

        return redirect()->back()->with('error', 'Support ticket not found.');
    }

}
