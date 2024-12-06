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
}
