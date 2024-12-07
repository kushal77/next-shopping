<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppSetting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = AppSetting::all();
        return view('admin.setting', compact('settings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        foreach($request->appsetting as $key=>$value){
            AppSetting::where('code',$key)->update(['value'=>$value]);
        }
        return redirect()->back()->withSuccess('App Setting has been successfully updated.');
    }
}
