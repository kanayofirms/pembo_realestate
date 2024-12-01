<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsModel;

class TransactionsController extends Controller
{
    public function transactions_index(Request $request)
    {
        // Build the base query with the join
        $query = TransactionsModel::select('transactions.*', 'users.name')
            ->join('users', 'users.id', '=', 'transactions.user_id');

        // Apply filters dynamically
        if ($request->filled('id')) {
            $query->where('transactions.id', $request->id);
        }

        if ($request->filled('user_id')) {
            $query->where('users.name', 'like', '%' . $request->user_id . '%');
        }

        if ($request->filled('order_number')) {
            $query->where('transactions.order_number', 'like', '%' . $request->order_number . '%');
        }

        if ($request->filled('transaction_id')) {
            $query->where('transactions.transaction_id', 'like', '%' . $request->transaction_id . '%');
        }

        if ($request->filled('amount')) {
            $query->where('transactions.amount', 'like', '%' . $request->amount . '%');
        }

        if ($request->filled('is_payment')) {
            $query->where('transactions.is_payment', $request->is_payment);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('transactions.created_at', $request->created_at);
        }

        if ($request->filled('updated_at')) {
            $query->whereDate('transactions.updated_at', $request->updated_at);
        }

        // Execute the query
        $data['getRecord'] = $query->get();

        return view('admin.transactions.list', $data);
    }
}
