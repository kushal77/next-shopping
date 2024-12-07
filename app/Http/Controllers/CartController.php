<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\CartDetail;
use Cookie;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Coupon;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    protected $sessionId;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()) {
                $cartItems = Cart::where('user_id',auth()->user()->id)->pluck('item_count')->first();
                if (!$cartItems) {
                    $cartItems = 0;
                }
            }else{
                if (Cookie::get('hitechcook')) {
                    $sessionId = Cookie::get('hitechcook');
                }else{
                    Cookie::queue('hitechcook', session()->getId(), 1440);
                    $sessionId = Cookie::get('hitechcook');
                }
                $cartItems = Cart::where('session_id',$sessionId)->pluck('item_count')->first();
                if (!$cartItems) {
                    $cartItems = 0;
                }
                $this->sessionId = $sessionId;
            }
            view()->share(['searchbrands'=>Brand::where('status',1)->pluck('title','alias')->toArray()]);
            view()->share(['cartItems'=>$cartItems]);
            return $next($request);
        });
    }

    public function cart(){
        if (auth()->user()) {
            $cart = Cart::with('cartdetails.product')->where('user_id',auth()->user()->id)->first();
        }else{
            $cart = Cart::with('cartdetails.product')->where('session_id',$this->sessionId)->first();
        }
        return view('client.cart.index',compact('cart'));
    }

    public function addtocart(Request $request, $api = false){
        try{
            if ($api) {
                $productId = $request->productId;
                if ($request->has('sessionId') && $request->sessionId != "") {
                    $this->sessionId = $request->sessionId;
                    $user = null;
                }else{
                    $user = JWTAuth::parseToken()->authenticate();
                }
            }else{
                $productId = decrypt($request->item);
                $user = auth()->user();
            }
            if ($user) {
                $cart = Cart::where('user_id',$user->id)->first();
            }else{
                $cart = Cart::where('session_id',$this->sessionId)->first();
            }
            if ($cart) {
                $checkitemincart = CartDetail::where('cart_id',$cart->id)->where('product_id',$productId)->first();
                if ($checkitemincart) {
                    $this->addproductincart($cart,$checkitemincart,$request);
                }else{
                    $this->addnewproductincart($cart,$productId,$request);
                }
                if($api){
                    return response()->json([
                        'status' => 200,
                        'response' => true,
                        'msg' => 'Product added to cart'
                    ]);
                }
                return response()->json(['success'=>'OK']);
            }else{
                if ($user) {
                    $res = $this->addfirstproduct($request,$productId,$user->id,null);
                }else{
                    $res = $this->addfirstproduct($request,$productId,0,$this->sessionId);
                }
                if($api){
                    if ($res) {
                        return response()->json([
                            'status' => 200,
                            'response' => true,
                            'msg' => 'Product added to cart'
                        ]);
                    }
                    return jsonize([], false, 404);
                }

                if ($res) {
                    return response()->json(['success'=>'OK']);
                }else{
                    return response()->json(['error'=>'Failed']);
                }
            }
        }catch(\Exception $e){
            if($api){
                return response()->json([
                    'status' => 200,
                    'response' => false,
                    'msg' => 'Product Not Found'
                ]);
            }
            return response()->json(['error'=>'Product Not Found']);
        }
    }

    public function addfirstproduct($request,$productId,$userId,$sessionId){
        $product = Product::whereId($productId)->first();
        $formdata['session_id'] = $sessionId;
        $formdata['user_id'] = $userId;
        $formdata['item_count'] = $request->qty;
        $formdata['sub_total'] = $product->net_price;
        $formdata['total'] = $request->qty * $product->net_price;
        $formdata['currency'] = $product->currency;
        $cart = Cart::create($formdata);
        if ($cart) {
            CartDetail::create([
                'cart_id'       =>  $cart->id,
                'product_id'    =>  $product->id,
                'currency'      =>  $product->currency,
                'net_price'     =>  $product->net_price,
                'quantity'      =>  $request->qty,
                'total'         =>  $request->qty * $product->net_price,
            ]);
            return 1;
        }else{
            return 0;
        }
    }

    public function addproductincart($cart,$checkitemincart,$request){
        $checkitemincart->update([
            'quantity'  =>  $checkitemincart->quantity+$request->qty,
            'total'     =>  ($checkitemincart->quantity+$request->qty)*$checkitemincart->net_price
        ]);
        $cart->update([
            'item_count'=>CartDetail::where('cart_id',$cart->id)->sum('quantity'),
            'sub_total'=>CartDetail::where('cart_id',$cart->id)->sum('total'),
            'total' =>CartDetail::where('cart_id',$cart->id)->sum('total') - $cart->discount
        ]);
        return 1;
    }

    public function addnewproductincart($cart,$productId,$request){
        $product = Product::whereId($productId)->first();
        CartDetail::create([
            'cart_id'       =>  $cart->id,
            'product_id'    =>  $productId,
            'currency'      =>  $product->currency,
            'net_price'     =>  $product->net_price,
            'quantity'      =>  $request->qty,
            'total'         =>  $request->qty * $product->net_price,
        ]);
        $cart->update([
            'item_count'=>CartDetail::where('cart_id',$cart->id)->sum('quantity'),
            'sub_total'=>CartDetail::where('cart_id',$cart->id)->sum('total'),
            'total' =>CartDetail::where('cart_id',$cart->id)->sum('total') - $cart->discount
        ]);
        return 1;
    }

    public function removeitemfromcart(Request $request,$api = false){
        try{
            if ($api) {
                $cartDetailId = $request->cartDetailId;
                if ($request->has('sessionId') && $request->sessionId != null) {
                    $this->sessionId = $request->sessionId;
                    $user = null;
                }else{
                    $user = JWTAuth::parseToken()->authenticate();
                }
            }else{
                $user = auth()->user();
                $cartDetailId = decrypt($request->item);
            }
            if ($user) {
                $cart = Cart::where('user_id',$user->id)->first();
            }else{
                $cart = Cart::where('session_id',$this->sessionId)->first();
            }
            $cartItemscount = CartDetail::where('cart_id',$cart->id)->count();
            $cartItem = CartDetail::whereId($cartDetailId)->first();
            if($cartItemscount > 1){
                $cart->update([
                    'item_count' => $cart->item_count - $cartItem->quantity,
                    'sub_total' => $cart->sub_total -$cartItem->total,
                    'total' => $cart->total - $cartItem->total,
                ]);
            }else{
                $cart->delete();
            }
            $cartItem->delete();
            if($api){
                return response()->json([
                    'status' => 200,
                    'response' => true,
                    'msg' => 'Item has been removed from cart'
                ]);
            }
            return response()->json(['success'=>'OK','cartItems'=>$cartItemscount]);
        }catch(\Exception $e){
            if($api){
                return response()->json([
                    'status' => 200,
                    'response' => false,
                    'msg' => 'Product Not Found'
                ]);
            }
            return response()->json(['error'=>'Product Not Found']);
        }
    }

    public function updateitemincart(Request $request){
        $items = $request->all();
        if (auth()->user()) {
            $cart = Cart::where('user_id',auth()->user()->id)->first();
        }else{
            $cart = Cart::where('session_id',$this->sessionId)->first();
        }
        foreach ($items as $key => $value) {
            $cartItem = CartDetail::whereId(decrypt($key))->first();
            $cart->update([
                'item_count' => $cart->item_count - $cartItem->quantity + $value,
                'sub_total' => $cart->sub_total -$cartItem->total + $value*$cartItem->net_price,
                'total' => $cart->total - $cartItem->total + $value*$cartItem->net_price,
            ]);
            $cartItem->update([
                'quantity' => $value,
                'total' =>  $value*$cartItem->net_price
            ]);
        }
        return response()->json(['success'=>'OK']);
    }

    public function addcoupontocart(Request $request,$api = false){
        $coupon = Coupon::where('code',$request->code)->first();
        if ($coupon) {
            if ($api) {
                if ($request->has('sessionId') && $request->sessionId != null) {
                    $this->sessionId = $request->sessionId;
                    $user = null;
                }else{
                    $user = JWTAuth::parseToken()->authenticate();
                }
            }else{
                $user = auth()->user();
            }
            if ($user) {
                $cart = Cart::where('user_id',$user->id)->first();
            }else{
                $cart = Cart::where('session_id',$this->sessionId)->first();
            }
            if (!$cart) {
                if ($api) {
                    return jsonize([], true, 200, 'Cart Not Found');
                }
                return response()->json(['error'=>'Cart Not Found']);
            }
            if ($request->type==1) {
               if ($cart->discount_code) {
                    if ($api) {
                        return jsonize([], true, 200, 'Coupon Code Exists');
                    }
                    return response()->json(['error'=>'Coupon Code Exists']);
                }
                $cart->update([
                    'discount_code' =>  $request->code,
                    'discount'      =>  $coupon->discount,
                    'total'         =>  $cart->total - $coupon->discount
                ]);
                if ($api) {
                    return jsonize($coupon->discount, true, 200, 'Coupon code successfully added');
                }
                return response()->json(['success'=>'Coupon code successfully added','discount'=>$coupon->discount]);
            }else{
                $cart->update([
                    'discount_code' =>  null,
                    'discount'      =>  0,
                    'total'         =>  $cart->total + $coupon->discount
                ]);
                if ($api) {
                    return jsonize($coupon->discount, true, 200, 'Coupon code successfully removed');
                }
                return response()->json(['success'=>'Coupon code successfully removed','discount'=>$coupon->discount]);
            }
        }
        if ($api) {
            return jsonize(null, false, 200, 'Invalid Coupon Code');
        }
        return response()->json(['error'=>'Invalid Coupon Code']);
    }
}
