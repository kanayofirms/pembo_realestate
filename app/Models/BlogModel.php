<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class BlogModel extends Model
{
    use HasFactory;

    protected $table = 'blog';

    static public function getAllRecord()
    {
        $return = self::select('blog.*')
            ->orderBy('id', 'desc');

        // Search Box Start
        if (!empty(Request::get('id'))) {
            $return = $return->where('blog.id', '=', Request::get('id'));
        }

        if (!empty(Request::get('title'))) {
            $return = $return->where('blog.title', 'like', '%' . Request::get('title') . '%');
        }

        if (!empty(Request::get('slug'))) {
            $return = $return->where('blog.slug', 'like', '%' . Request::get('slug') . '%');
        }
        // Search Box End
        $return = $return->paginate(20);

        return $return;
    }
}
