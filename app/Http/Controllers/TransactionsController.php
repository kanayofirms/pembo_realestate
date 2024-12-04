<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsModel;
use Auth;

class TransactionsController extends Controller
{

    public function destroy($id)
    {
        TransactionsModel::find($id)->delete();
        return redirect()->back();
    }
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
        $data['getRecord'] = $query->where('transactions.is_delete', '=', 0)->get();

        return view('admin.transactions.list', $data);
    }

    public function transactions_edit($id)
    {
        $data['getRecord'] = TransactionsModel::find($id);
        return view('admin.transactions.edit', $data);
    }

    public function transactions_update($id, Request $request)
    {
        $save = TransactionsModel::find($id);
        $save->order_number = trim($request->order_number);
        $save->transaction_id = trim($request->transaction_id);
        $save->amount = trim($request->amount);
        $save->is_payment = trim($request->is_payment);
        $save->save();

        return redirect('admin/transactions')->with('success', 'Transactions Successfully Updated!');
    }

    public function transactions_delete($id)
    {
        $softDelete = TransactionsModel::find($id);
        $softDelete->is_delete = 1;
        $softDelete->save();

        return redirect()->back()->with('success', 'Record Successfully Soft Deleted!');
    }

    // Agent Side Code
    public function agent_transactions_add(Request $request)
    {
        return view('agent.transactions.add');
    }

    public function agent_transactions_store(Request $request)
    {
        $save = new TransactionsModel;
        $save->user_id = Auth::user()->id;
        $save->order_number = trim($request->order_number);
        $save->transaction_id = trim($request->transaction_id);
        $save->amount = trim($request->amount);
        $save->is_payment = trim($request->is_payment);
        $save->save();

        return redirect('agent/transactions_list')->with('success', 'Transactions Successfully Added!');
    }

    public function agent_transactions_list(Request $request)
    {
        $data['getRecord'] = TransactionsModel::getAgentRecord(Auth::user()->id);
        return view('agent.transactions.list', $data);
    }
}
