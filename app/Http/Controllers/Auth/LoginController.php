<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Brand;
use App\Model\Cart;
use Cookie;
use App\Model\Product;
use App\Model\Category;
use App\Model\Banner;
use App\Model\CartDetail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $sessionId;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth()->user()) {
            $cartItem = Cart::where('user_id',auth()->user()->id)->pluck('item_count')->first();
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
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user){
        $cart = Cart::where('session_id',Cookie::get('hitechcook'))->first();
        if($cart){
            $oldCart = Cart::where('user_id',$user->id)->first();
            if ($oldCart) {
                CartDetail::where('cart_id',$oldCart)->delete();
                $oldCart->delete();
            }
            $cart->update(['user_id'=>$user->id,'session_id'=>null]);
        }
        if ($request->redirectTo) {
            return redirect()->to($request->redirectTo);
        }
    }
}
