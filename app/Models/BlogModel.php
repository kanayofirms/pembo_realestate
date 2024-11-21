<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;

    protected $table = 'blog';

    static public function getAllRecord()
    {
        $return = self::select('blog.*')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $return;
    }
}
