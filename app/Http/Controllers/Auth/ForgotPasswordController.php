<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
        }
        view()->share(['searchbrands'=>Brand::where('status',1)->pluck('title','alias')->toArray()]);
        view()->share(['cartItems'=>$cartItems]);
        // $this->middleware('guest');
    }

    public function forgotPassword(Request $request){
        return view('client.passwords.forgot-psw', compact('brands'));
    }

    public function sendResetPasswordMail(Request $request){
        $validate = $this->validate($request, [
            'email' => 'required|email'
        ]);
        if($validate){
            $user = User::where('email', $request->email)->first();
            if($user){
                Mail::send('email_template.resetpassword',['user'=>$user],
                    function ($m) use ($user) {
                        $m->from('info@hitech.com', 'Hitech');
                        $m->to($user['email'], $user['first_name'])->subject('Reset Password Hitech!');
                    }
                );
                return redirect()->back()->withSuccess('Password reset link have been sent to '. $user['email'].'. Please check your email.');
            }else{
                return redirect()->back()->withError('Email entered doesnot match our records.');
            }

        }
    }

}
