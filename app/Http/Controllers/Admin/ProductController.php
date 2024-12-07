<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use App\Model\ProductImage;
use App\Model\Tag;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('images')->orderby('created_at', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::where('status',1)->pluck('title','id')->toArray();
        $categories = Category::with('childrens')->where('status',1)->where('parent_id',0)->get();
        return view('admin.product.add',compact('brands','categories'));
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
            'short_text' => 'required',
            'description' => 'required',
            'image.*' => 'required|mimes:jpeg,bmp,png',
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'status' => 'required',
            'cat_id' => 'required',
            'brand_id' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'special_deals' => 'required',
            'flash_sale' => 'required',
            'top_sales' => 'required',
            'most_liked' => 'required',
            'just_for_you' => 'required'
        ],[
            'cat_id.required'=>'The category field is required',
            'brand_id.required'=>'The brand field  is required',
        ]);
        $images = $request->file('image');
        if (!$images) {
            return redirect()->back()->withErrors('The image field is required');
        }
        $data = $request->all();
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $data['custom'] = json_encode($request->custom);
        $data['net_price'] = $data['price'] - $data['discount'];
        $product = Product::create($data);
        if ($product) {
            $images = $request->file('image');
            foreach ($images as $image) {
                if($image != ''){
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/product'), $new_name);
                    ProductImage::create(['product_id'=>$product->id,'image'=>$new_name]);
                }
            }
            $tags = explode(',', $request->tags);
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    Tag::create(['product_id'=>$product->id,'tag'=>$tag]);
                }
            }
        }
        return redirect()->back()->withSuccess('Product has been successfully created.');
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
        $brands = Brand::where('status',1)->pluck('title','id')->toArray();
        $categories = Category::with('childrens')->where('status',1)->where('parent_id',0)->get();
        $product = Product::whereId($id)->first();
        return view('admin.product.edit', compact('product','brands','categories'));
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
            'short_text' => 'required',
            'description' => 'required',
            'image.*' => 'required|mimes:jpeg,bmp,png',
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'status' => 'required',
            'brand_id' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'special_deals' => 'required',
            'flash_sale' => 'required',
            'top_sales' => 'required',
            'most_liked' => 'required',
            'just_for_you' => 'required'
        ]);
        $data = $request->except(['_token','_method','metatitle','metakey','metadesc','image','tags']);
        $data['custom'] = json_encode($request->custom);
        $data['net_price'] = $data['price'] - $data['discount'];
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $product = Product::whereId($id)->update($data);
        if ($product) {
            $images = $request->file('image');
            if ($images) {
               foreach ($images as $image) {
                    if($image != ''){
                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/product'), $new_name);
                        ProductImage::create(['product_id'=>$id,'image'=>$new_name]);
                    }
                }
            }
            Tag::where('product_id',$id)->delete();
            $tags = explode(',', $request->tags);
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    Tag::create(['product_id'=>$id,'tag'=>$tag]);
                }
            }
        }
        return redirect()->back()->withSuccess('Selected Product has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Product::whereId($request->user_id)->delete();
        return redirect()->back()->withSuccess('Selected Product has been successfully deleted.');
    }

    public function removeimage(Request $request){
        ProductImage::whereId($request->id)->delete();
        return response()->json(['success'=>'Ok']);
    }
}
