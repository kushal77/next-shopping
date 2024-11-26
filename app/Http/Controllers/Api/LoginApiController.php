<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Mail;
use App\Model\Cart;
use App\Model\CartDetail;

class LoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return jsonize([], false, 400, "Invalid Credentials");
                }
            } catch (JWTException $e) {
                return jsonize([], false, 500, "Could not create token");

            }
            $user_data = JWTAuth::user();
            $cart = Cart::where('session_id',$request->sessionId)->first();
            if($cart){
                $oldCart = Cart::where('user_id',$user_data->id)->first();
                if ($oldCart) {
                    CartDetail::where('cart_id',$oldCart)->delete();
                    $oldCart->delete();
                }
                $cart->update(['user_id'=>$user_data->id,'session_id'=>null]);
            }
            $data = [];
            $data = array_add($data,"token",$token);
            $data = array_add($data,"user_data",$user_data->toArray());
            return jsonize($data, true, 200, "Login Success");

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        /** send confirm mail**/
        Mail::send('email_template.verifyemail',['user'=>$user],
            function ($m) use ($user) {
                $m->from('info@hitech.com', 'Hitech');
                $m->to($user['email'], $user['first_name'])->subject('Verify Email Hitech!');
            }
        );
        $token = JWTAuth::fromUser($user);

        $response = [
            'status' => 200,
            'response' => true,
            'msg' => "Registration Successful! You must confirm your account. Please check your email for the confirmation link."
        ];
    
        return response()->json($response);

    }

}
