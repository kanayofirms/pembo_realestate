<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create()
    {
        $input = [
            'name' => 'Mobile Phone',
            'details' => [
                'brand' => 'RedMi',
                'tags' => ['Red', 'Black', 'White']
            ]
        ];

        return ItemModel::create($input);
    }

    public function search()
    {
        $item = ItemModel::whereJsonContains('details->tags', 'White')->get();
        // $item = ItemModel::get(); All Record get!

        return $item;
    }
}
