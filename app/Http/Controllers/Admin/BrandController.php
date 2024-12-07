<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Product;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderby('created_at', 'DESC')->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.add');
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
            'cat_image' => 'required|mimes:jpeg,bmp,png',
            'cat_bg_image' => 'required|mimes:jpeg,bmp,png',
            'status' => 'required',
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
        ]);
        $data = $request->all();
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brand'), $new_name);
            $data['image'] = $new_name;
        }
        $cat_image = $request->file('cat_image');
        if($cat_image != ''){
            $new_name = rand() . '.' . $cat_image->getClientOriginalExtension();
            $cat_image->move(public_path('images/brand'), $new_name);
            $data['cat_image'] = $new_name;
        }
        $cat_bg_image = $request->file('cat_bg_image');
        if($cat_bg_image != ''){
            $new_name = rand() . '.' . $cat_bg_image->getClientOriginalExtension();
            $cat_bg_image->move(public_path('images/brand'), $new_name);
            $data['cat_bg_image'] = $new_name;
        }
        Brand::create($data);
        return redirect()->back()->withSuccess('Brand has been successfully created.');
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
        $brand = Brand::whereId($id)->first();
        return view('admin.brand.edit', compact('brand'));
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
            'cat_image' => 'mimes:jpeg,bmp,png',
            'cat_bg_image' => 'mimes:jpeg,bmp,png',
            'status' => 'required',
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
        ]);
        $data = $request->except(['_token','_method','metatitle','metakey','metadesc']);
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brand'), $new_name);
            $data['image'] = $new_name;
        }
        $cat_image = $request->file('cat_image');
        if($cat_image != ''){
            $new_name = rand() . '.' . $cat_image->getClientOriginalExtension();
            $cat_image->move(public_path('images/brand'), $new_name);
            $data['cat_image'] = $new_name;
        }
        $cat_bg_image = $request->file('cat_bg_image');
        if($cat_bg_image != ''){
            $new_name = rand() . '.' . $cat_bg_image->getClientOriginalExtension();
            $cat_bg_image->move(public_path('images/brand'), $new_name);
            $data['cat_bg_image'] = $new_name;
        }
        Brand::whereId($id)->update($data);
        return redirect()->back()->withSuccess('Selected Brand has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = Product::where('brand_id',$request->user_id)->get();
        foreach($products as $product){
            $prod = Product::find($product->id);
            $prod->status = StatusEnum::Unpublished;
            $prod->save();
        }
        $brand = Brand::find($request->user_id);
        $brand->status = StatusEnum::Unpublished;
        $brand->save();
        return redirect()->back()->withSuccess('Selected Brand has been successfully deleted.');
    }
}
