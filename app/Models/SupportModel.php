<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SupportModel extends Model
{
    use HasFactory;

    protected $table = 'support';

    static public function getSupportList($request){
        $return = self::select('support.*')
            ->orderBy('id', 'desc')->paginate(20);

        return $return;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
