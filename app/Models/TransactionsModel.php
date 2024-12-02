<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class TransactionsModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    static public function getAgentRecord($user_id)
    {
        return self::select('transactions.*', 'users.name')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('transactions.user_id', '=', $user_id)
            ->orderBy('transactions.id', 'desc')
            ->paginate(50);
    }
}
