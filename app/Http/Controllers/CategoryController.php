<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use Cookie;
use App\Model\Product;

class CategoryController extends Controller{
    
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

    public function index(Request $request,$alias){
        $value = $request->value;
        $searchbrand = null;
        $searchcategory = null;
        if ($request->brand) {
            $searchbrand = explode(',', $request->brand);
        }
        if ($request->category) {
            $searchcategory = explode(',', $request->category);
        }
        $minprice = $request->min;
        $maxprice = $request->max;
        $category = Category::where([['alias',$alias],['status',StatusEnum::Published]])->first();
        if (!$category) {
            abort('404');
        }
        if($category != null){
            if($category->parent_id != 0){
                $parentCategory = Category::where('id',$category->parent_id)->first();
                $childCategories = [];
            }else{
                $childCategories = Category::where([['parent_id',$category->id],['status',StatusEnum::Published]])->pluck('id')->toArray();
                $parentCategory = null;
            }
        }else{
            $parentCategory = null;
        }
        $products = Product::where([['cat_id',$category->id],['status',StatusEnum::Published]])
                            ->orWhereIn('cat_id',$childCategories);
        if ($searchbrand) {
            $products = $products->whereHas('brand', function ($q) use ($searchbrand){
                $q->whereIn('brands.alias',$searchbrand);
            });
        }
        if ($searchcategory) {
            $products = $products->whereHas('category', function ($q) use ($searchcategory){
                $q->whereIn('categories.alias',$searchcategory);
            });
        }
        if ($value) {
            $products = $products->where('title','like','%'.$value.'%');
        }
        if ($minprice) {
            $products = $products->where('net_price','>=',$minprice);
        }
        if ($maxprice) {
            $products = $products->where('net_price','<=',$maxprice);
        }
        if ($request->choosetype) {
            if ($request->choosetype=='hightolow') {
                $products->orderBy('net_price','desc');
            }else{
                $products->orderBy('net_price','asc');
            }
        }
        $minprice = floor($products->min('net_price'));
        $maxprice = floor($products->max('net_price'))+1;
        $products = $products->paginate(1)->appends(request()->query());
        $brandIds = Product::where([['cat_id',$category->id],['status',StatusEnum::Published]])
                            ->orWhereIn('cat_id',$childCategories)
                            ->pluck('brand_id')
                            ->toArray();
        $brands = Brand::whereIn('id',$brandIds)->where('status',StatusEnum::Published)->get();
        return view('client.category.view',compact('category','products','brands','parentCategory','minprice','maxprice'));
    }
}
