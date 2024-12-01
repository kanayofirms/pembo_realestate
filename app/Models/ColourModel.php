<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ColourModel extends Model
{
    use HasFactory;

    protected $table = 'colour';

    static public function getRecordAll()
    {
        $return = self::select('colour.*')->orderBy('colour.id', 'desc');

        // Search Start
        if (!empty(Request::get('id'))) {
            $return = $return->where('colour.id', '=', Request::get('id'));
        }

        if (!empty(Request::get('name'))) {
            $return = $return->where('colour.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('created_at'))) {
            $return = $return->where('colour.created_at', 'like', '%' . Request::get('created_at') . '%');
        }

        $return = $return->get();
        return $return;
    }
}
