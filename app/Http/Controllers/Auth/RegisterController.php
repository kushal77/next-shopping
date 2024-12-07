<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->registered($request, $user);

        return redirect()->route('login')->withSuccess('Registration Successful! You must confirm your account. Please check your email for the confirmation link.');
    }
    protected function registered(Request $request, $user){
        /** send confirm mail**/
        Mail::send('email_template.verifyemail',['user'=>$user],
            function ($m) use ($user) {
                $m->from('aavishbaj@gmail.com', 'Next Shopping');
                $m->to($user['email'], $user['first_name'])->subject('Verify Email Next Shopping!');
            }
        );
        return 1;
    }

    public function verifyemail($id){
        try{
            $id = base64_decode($id);
            User::whereId($id)->update(['status'=>1,'email_verified_at'=>Carbon::now()]);
            return redirect()->route('login')->withVerify('Your email has been verified, You can now login');
        }catch(\Exception $e){
            return redirect()->route('login')->withError('Error Occured!');
        }
    }
}
