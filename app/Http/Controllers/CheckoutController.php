<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use Cookie;
use App\Model\Checkout;
use App\Model\Order;
use App\Model\OrderDetail;
use App\User;
use Carbon\Carbon;
use App\Model\CartDetail;
use Mail;
use DB;
use App\Model\Product;
use App\Model\AppSetting;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckoutController extends Controller{
    
    public function __construct(){
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
            }
            view()->share(['searchbrands'=>Brand::where('status',1)->pluck('title','alias')->toArray()]);
            view()->share(['cartItems'=>$cartItems]);
            return $next($request);
        });
    }

    public function index(){
        if (auth()->user()) {
            $cartlists = Cart::with('cartdetails.product')->where('user_id',auth()->user()->id)->first();
            if ($cartlists) {
                return view('client.checkout.index',compact('cartlists'));
            }
            return redirect()->route('cart');
        }
        return redirect()->route('login');
    }

    public function saveorder(Request $request, $api = false){
        if (!$api && !auth()->user()) {
            return redirect()->route('cart');
        }
        $request->validate([
            'phone_no' => 'required',
            'region' => 'required',
            'city' => 'required',
            'address' => 'required',
            'post_code' => 'required',
        ]);
        if ($api) {
            $user = JWTAuth::parseToken()->authenticate();
        }else{
            $user = auth()->user();
        }
        $cart = Cart::with('cartdetails')->where('user_id',$user->id)->first();
        User::whereId($user->id)->update(['phone_no'=>$request->phone_no]);
        if($cart){
            DB::beginTransaction();
            $emi = 0;
            if($request->emi){
                $emi = 1;
            }
            $deliveryDays = AppSetting::getSettingByCode(110);
            $shipping = AppSetting::getSettingByCode(109);
            $order = Order::Create([
                'user_id'           =>  $cart->user_id,
                'currency'          =>  $cart->currency,
                'net_price'         =>  $cart->sub_total,
                'discount_code'     =>  $cart->discount_code,
                'discount'          =>  $cart->discount,
                'shipping'          =>  $shipping,
                'total'             =>  $cart->total + $shipping,
                'order_number'      =>  'ORD'.strtoupper(str_random(12)),
                'expected_delivery' =>  Carbon::now()->addDays($deliveryDays),
                'status'            =>  0,
                'shipping_address'  =>  json_encode([
                    'region'    =>  $request->region,
                    'city'      =>  $request->city,
                    'address'   =>  $request->address,
                    'post_code' =>  $request->post_code
                ]),
                'billing_address'   =>  json_encode([
                    'region'    =>  $request->region,
                    'city'      =>  $request->city,
                    'address'   =>  $request->address,
                    'post_code' =>  $request->post_code
                ]),
                'emi'           =>  $emi
            ]);
            foreach ($cart->cartdetails as $cartitem) {
                OrderDetail::create([
                    'order_id'     =>  $order->id,
                    'currency'     =>  $cartitem->currency,
                    'item_id'      =>  $cartitem->product_id,
                    'net_price'    =>  $cartitem->net_price,
                    'quantity'     =>  $cartitem->quantity,
                    'total'        =>  $cartitem->total,
                ]);
                $product = Product::whereId($cartitem->product_id)->first();
                $product->update([
                    'quantity' => $product->quantity - 1
                ]);
            }
            $cart->delete();
            CartDetail::where('cart_id',$cart->id)->delete();
            $user['ordernumber'] = $order->order_number; 
            Mail::send('email_template.confirmorder',['user'=>$user],
                function ($m) use ($user) {
                    $m->from($user['email']);
                    $m->to($user['email'])->subject('Hitech Order Confirmation.');
                }
            );
            DB::commit();
            if ($api) {
                $orderDetails = [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone_no' => $request->phone_no,
                    'region' => $request->region,
                    'city' => $request->city,
                    'address' => $request->address,
                    'post_code' => $request->post_code,
                    'order_number'  =>  $order->order_number,
                    'currency'  =>  $order->currency,
                    'order_date'    =>  Carbon::parse($order->created_at)->format('D M d Y'),
                    'sub_total'     =>  $order->net_price,
                    'shipping'      =>  $order->shipping,
                    'discount'      =>  $order->discount,
                    'total'         =>  $order->total,
                    'shipping_days' =>  AppSetting::getSettingByCode(111),
                    'items'         =>  OrderDetail::with('product.images')->where('order_id',$order->id)->get(),
                ];
                return jsonize($orderDetails, true, 200);
            }else{
                return redirect()->route('confirmOrder',$order->order_number);
            }
        }
        return redirect()->route('cart');
    }

    public function confirmOrder($ordernumber){
        if (!auth()->user()) {
            return redirect()->route('cart');
        }
        $order = Order::with('detail.product','user')->where('order_number',$ordernumber)->where('user_id',auth()->user()->id)->first();
        if ($order) {
            return view('client.confirm-order',compact('order'));
        }
        return redirect()->route('cart');
    }
}
