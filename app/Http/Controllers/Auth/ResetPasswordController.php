<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

    public function showResetPassword($id){
        try{
            $email = base64_decode($id);
            $token = DB::table('password_resets')->where('email', $email)->pluck('token')->first();
            return view('client.passwords.reset', compact('token'));
        }catch(\Exception $e){
            return redirect()->route('forgot-password')->withError('Error Occured!');
        }
    }

    public function resetPassword(Request $request){
        $user = User::where('email', $request->email)->first();

        $password = $request->password;
        $confirm_password = $request->password_confirmation;
        if($password == $confirm_password){
            $user->password = bcrypt($password);
            $user->save();
            return redirect()->route('login')->withSuccess('Password Updated successfully!');
        }else{
            return redirect()->back()->withError('Failed to Update Password.');
        }

    }
}
