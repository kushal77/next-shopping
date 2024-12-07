<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderby('created_at', 'DESC')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
            'status' => 'required'
        ]);
        $data = $request->all();
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banner'), $new_name);
            $data['image'] = $new_name;
        }
        Banner::create($data);
        return redirect()->back()->withSuccess('Banner has been successfully created.');
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
        $banner = Banner::whereId($id)->first();
        return view('admin.banners.edit', compact('banner'));
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
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
            'status' => 'required'
        ]);
        $data = $request->except(['_token','_method']);
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banner'), $new_name);
            $data['image'] = $new_name;
        }
        Banner::whereId($id)->update($data);
        return redirect()->back()->withSuccess('Selected Banner has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Banner::whereId($request->user_id)->delete();
        return redirect()->back()->withSuccess('Selected Banner has been successfully deleted.');
    }
}
