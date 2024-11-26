<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Model\CartDetail;

class CartApiController extends Controller
{
    protected $cartController;
    protected $checkoutController;

    public function __construct(CartController $cartController,CheckoutController $checkoutController)
    {
        $this->cartController       =   $cartController;
        $this->checkoutController   =   $checkoutController;
    }

    public function getCartItems(Request $request){
        try {
            if ($request->has('sessionId') && $request->sessionId != null) {
                $sessionId = $request->sessionId;
                $user = null;
            }else{
                $user = JWTAuth::parseToken()->authenticate();
            }
            if ($user) {
                $cart = Cart::with('cartdetails.product.images')->where('user_id',$user->id)->first();
            }else{
                $cart = Cart::with('cartdetails.product.images')->where('session_id',$sessionId)->first();
            }
            if ($cart) {
                return jsonize($cart, true, 200);
            }
            return jsonize(null, true, 200);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function addtoCart(Request $request){
        try{
            $cart = $this->cartController->addtoCart($request, true);
            return $cart;
        }catch(\Exception $e){
            return jsonize([], false, 500);
        }
    }

    public function removeItemFromCart(Request $request){
        try{
            $cart = $this->cartController->removeitemfromcart($request, true);
            return $cart;
        }catch(\Exception $e){
            return jsonize([], false, 500);
        }
    }

    public function addCouponToCart(Request $request){
        try{
            $cart = $this->cartController->addcoupontocart($request, true);
            return $cart;
        }catch(\Exception $e){
            return jsonize([], false, 500);
        }
    }

    public function updateItemInCart(Request $request){
        $items = $request->cartDetail;
        if ($request->has('sessionId') && $request->sessionId != null) {
            $sessionId = $request->sessionId;
            $user = null;
        }else{
            $user = JWTAuth::parseToken()->authenticate();
        }
        if ($user) {
            $cart = Cart::where('user_id',$user->id)->first();
        }else{
            $cart = Cart::where('session_id',$sessionId)->first();
        }
        foreach ($items as $item) {
            $cartItem = CartDetail::whereId($item['id'])->first();
            $cart->update([
                'item_count' => $cart->item_count - $cartItem->quantity + $item['qty'],
                'sub_total' => $cart->sub_total - $cartItem->total + $item['qty']*$cartItem->net_price,
                'total' => $cart->total - $cartItem->total + $item['qty']*$cartItem->net_price,
            ]);
            $cartItem->update([
                'quantity' => $item['qty'],
                'total' =>  $item['qty']*$cartItem->net_price
            ]);
        }
        return response()->json([
            'status' => 200,
            'response' => true,
            'msg' => 'Your cart has been updated.'
        ]);
    }

    public function saveOrder(Request $request){
        try{
            $cart = $this->checkoutController->saveorder($request, true);
            return $cart;
        }catch(\Exception $e){
            return jsonize([], false, 500);
        }
    }
}
