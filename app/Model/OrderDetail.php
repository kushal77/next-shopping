<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'item_id','currency','net_price','quantity','total'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
}
