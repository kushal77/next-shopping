<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/backend';

    protected function guard(){
        return Auth::guard('admin');
    }
    public function showLoginForm(){
        return view('admin.login');
    }
    protected function credentials($request){
        $datas = $request->only($this->username(), 'password');
        $datas['status'] = 1;
        $datas['type'] = 1;
        return $datas;
    }
}
