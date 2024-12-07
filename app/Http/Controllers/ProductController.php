<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use Cookie;
use App\Model\Product;
use App\Model\EmiRate;

class ProductController extends Controller{
    
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->user()) {
                $cartItems = Cart::where('user_id',auth()->user()->id)->pluck('item_count')->first();
                if (!$cartItems) {
                    $cartItems = 0;
                }
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
            return $next($request);
        });
    }

    public function index($alias){
        $product = Product::where('alias',$alias)->first();
        $category = Category::where('id',$product->cat_id)->first();
        if($category != null){
            if($category->parent_id != 0){
                $parentCategory = Category::where('id',$category->parent_id)->first();
            }else{
                $parentCategory = null;
            }
        }else{
            $parentCategory = null;
        }
        $relatedProducts = Product::where([['cat_id',$product->cat_id],['brand_id',$product->brand_id],['id','!=',$product->id]])->orderBy('id','desc')->take(4)->get();
        if(count($relatedProducts) == 0){
            $relatedProducts = Product::where([['cat_id',$product->cat_id],['id','!=',$product->id]])->orderBy('id','desc')->take(4)->get();
            if(count($relatedProducts) == 0){
                $relatedProducts = Product::where([['brand_id',$product->brand_id],['id','!=',$product->id]])->orderBy('id','desc')->take(4)->get();
            }
        }
        $emirates = EmiRate::where('status',1)->get();
        return view('client.product.view',compact('product','category','parentCategory','relatedProducts','emirates'));
    }

    public function getrate(Request $request){
        $rate = EmiRate::where('status',1)->where('months',$request->months)->pluck('rate')->first();
        if ($rate) {
            return response()->json(['rate'=>$rate]);
        }
        return response()->json(['rate'=>0]);
    }
}
