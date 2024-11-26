<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = [
        'cart_id', 'product_id', 'currency', 'net_price','quantity','total'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
