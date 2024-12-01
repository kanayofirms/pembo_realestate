<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsModel;

class TransactionsController extends Controller
{
    public function transactions_index(Request $request)
    {
        $data['getRecord'] = TransactionsModel::select('transactions.*', 'users.name')->join('users', 'users.id', '=', 'transactions.user_id')->get();
        return view('admin.transactions.list', $data);
    }
}
