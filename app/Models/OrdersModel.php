<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getRecord()
    {
        $return = self::select('orders.*', 'product.title');
        $return = $return->join('product', 'product.id', '=', 'orders.product_id');

        $return = $return->orderBy('orders.id', 'desc')
            ->get();
        return $return;
    }

    public function getColour()
    {
        return $this->hasMany(OrdersDetailsModel::class, 'orders_id')
            ->select('orders_details.*', 'colour.name')
            ->join('colour', 'colour.id', '=', 'orders_details.colour_id');
    }
}
