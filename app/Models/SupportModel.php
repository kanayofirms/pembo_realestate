<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SupportModel extends Model
{
    use HasFactory;

    protected $table = 'support';

    static public function getSupportList($request)
    {
        $return = self::select('support.*')
            ->join('users', 'users.id', '=', 'support.user_id')
            ->orderBy('support.id', 'desc');

        if (!empty($request->id)) {
            $return->where('support.id', '=', $request->id);
        }

        if (!empty($request->user_id)) {
            $return->where('support.user_id', '=', $request->user_id);
        }

        if (!empty($request->title)) {
            $return->where('support.title', 'like', '%' . $request->title . '%');
        }

        if (!empty($request->status)) {
            $status = $request->status == '1000' ? 0 : $request->status;
            $return->where('support.status', '=', $status);
        }

        return $return->paginate(20); // Re-add pagination
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
