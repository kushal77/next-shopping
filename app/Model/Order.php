<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'currency', 'net_price', 'discount_code','discount','shipping','total','order_number','expected_delivery','status','shipping_address','billing_address','emi'
    ];

    public function status(){
        if ($this->status == 0) {
            return '<button class="btn btn-danger btn-xs">Pending</button>';
        }elseif ($this->status == 1) {
            return '<button class="btn btn-warning btn-xs">Shipped</button>';
        }elseif ($this->status == 2) {
            return '<button class="btn btn-success btn-xs">Completed</button>';
        }
    }

    public function emi(){
        if ($this->emi == 1) {
            return '<button class="btn btn-success btn-xs">Yes</button>';
        }elseif ($this->emi == 0) {
            return '<button class="btn btn-primary btn-xs">No</button>';
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
