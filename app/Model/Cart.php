<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'item_count', 'discount_code','discount','sub_total','total','currency'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function cartdetails()
    {
    	return $this->hasMany(CartDetail::class, 'cart_id');
    }
}
