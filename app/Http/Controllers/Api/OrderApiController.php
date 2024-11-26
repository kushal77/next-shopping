<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderApiController extends Controller{

    public function myOrder(){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $orders = Order::with('detail.product.images')->where('user_id',$user->id)->latest()->get();
            if ($orders) {
                return jsonize($orders, true, 200);
            }
            return jsonize([], true, 200);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }
}
