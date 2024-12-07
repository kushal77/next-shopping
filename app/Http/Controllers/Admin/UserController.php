<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('created_at', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8',
            'type' => 'required'
        ]);
        $this->validate($request, $request->storeRules());
        $password=bcrypt($request->password);
        User::create(array_merge($request->except(['_token', 'password','password_confirmation']),
            [
                'password' => $password
            ]));
        return redirect()->back()->withSuccess('New User has been successfully created.');
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
        $user = User::whereId($id)->first();
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',
            'password' => 'sometimes|nullable|same:password_confirmation|min:8',
            'password_confirmation' => 'sometimes|nullable|min:8',
            'type' => 'required'
        ]);
        $this->validate($request, $request->updateRules());
        if($request->password){
            $password=bcrypt($request->password);
            User::whereId($id)->update(array_merge($request->except(['_token','_method', 'password','password_confirmation']),
                [
                    'password' => $password
                ]));
        }else{
            User::whereId($id)->update($request->except(['_method', '_token','password','password_confirmation']));
        }
        return redirect()->back()->withSuccess('Selected User has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::whereId($request->user_id)->delete();
        return redirect()->back()->withSuccess('Selected User has been successfully deleted.');
    }
}
