<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Cart;
use Cookie;
use App\Model\Product;
use App\Model\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Model\Category;
use App\Model\Banner;
use Mail;
use App\Model\Order;
use App\Model\Page;

class HomeController extends Controller{

    public function __construct()
    {
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

    public function index(){
        $banners = Banner::where('status',1)->get();
        $rightbrands = Brand::where('status',1)->get();
        $rightcategories = Category::with('childrens')->where('parent_id',0)->where('status',1)->get();
        $categories = Category::where('parent_id','<>',0)->where('status',1)->get();
        $flashsales = Product::where('flash_sale',1)->where('status',1)->get();
        $newproducts = Product::where('status',1)->orderBy('created_at','desc')->limit(6)->get();
        $topsales = Product::where('top_sales',1)->where('status',1)->get();
        $specials = Product::where('special_deals',1)->where('status',1)->get();
        $mostlikes = Product::where('most_liked',1)->where('status',1)->get();
        $justforyous = Product::where('just_for_you',1)->where('status',1)->get();
        return view('client.home',compact('banners','rightbrands','rightcategories','categories','flashsales','newproducts','topsales','specials','mostlikes','justforyous'));
    }

    public function about(){
        return view('client.about');
    }

    public function privacypolicy(){
        return view('client.privacy-policy');
    }

    public function returnpolicy(){
        return view('client.return-policy');
    }

    public function terms(){
        return view('client.terms');
    }

    public function contact(){
        return view('client.contact');
    }

    public function saveContact(Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['message'] = $request->message;

        Mail::send('email_template.contactemail',['data'=>$data],
            function ($m) use ($data) {
                $m->from($data['email']);
                $m->to('maharjan.aakriti26@gmail.com')->subject('Contact Email');
            }
        );
                // dump('here');

        if('success'){
                return redirect()->back()->with('success','Contact Mail Sent Successfully');
            }

    }

    public function specialDeals(Request $request){
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
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('parent_id','<>',0)->get();
        $specialDeals = Product::with('images','brand')->where('status',1);
        if ($searchbrand) {
            $specialDeals = $specialDeals->whereHas('brand', function ($q) use ($searchbrand){
                $q->whereIn('brands.alias',$searchbrand);
            });
        }
        if ($searchcategory) {
            $specialDeals = $specialDeals->whereHas('category', function ($q) use ($searchcategory){
                $q->whereIn('categories.alias',$searchcategory);
            });
        }
        if ($value) {
            $specialDeals = $specialDeals->where('title','like','%'.$value.'%');
        }
        if ($minprice) {
            $specialDeals = $specialDeals->where('net_price','>=',$minprice);
        }
        if ($maxprice) {
            $specialDeals = $specialDeals->where('net_price','<=',$maxprice);
        }
        if ($request->choosetype) {
            if ($request->choosetype=='hightolow') {
                $specialDeals->orderBy('net_price','desc');
            }else{
                $specialDeals->orderBy('net_price','asc');
            }
        }
        $specialDeals = $specialDeals->paginate(1)->appends(request()->query());
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('parent_id','<>',0)->get();
        $minprice = floor(Product::min('net_price'));
        $maxprice = floor(Product::max('net_price'))+1;
        return view('client.special-deals',compact('specialDeals','brands','categories','minprice','maxprice'));
    }

    public function service(){
        return view('client.service');
    }

    public function faqs(){
        $faqs = Faq::where('status',1)->get();
        return view('client.faqs',compact('faqs'));
    }

    public function searchFaq(Request $request){

         $q = Input::get ( 'q' );

        $faqs = Faq::where ( 'faqs.question', 'LIKE', '%' . $q . '%' )->get();
        return view('client.faqs',compact('q','faqs','query'));
    }


    public function cart(){
        return view('client.cart');
    }

    public function checkout(){
        return view('client.checkout');
    }

    public function profile(){
        $user = Auth::user();
        $orders = Order::with('detail.product')->where('user_id',$user->id)->latest()->get();
        return view('client.profile', compact('user','orders'));
    }

    public function loginRegister(){
        return view('client.login-register');
    }

    public function category(){
        return view('client.category');
    }

    public function detail(){
        return view('client.detail');
    }

    public function search(Request $request){
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
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('parent_id','<>',0)->get();
        $products = Product::with('brand')->where('status',1);
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
            $products = $products->where('net_price','>',$minprice);
        }
        if ($maxprice) {
            $products = $products->where('net_price','<',$maxprice);
        }
        if ($request->choosetype) {
            if ($request->choosetype=='hightolow') {
                $products->orderBy('net_price','desc');
            }else{
                $products->orderBy('net_price','asc');
            }
        }
        $products = $products->paginate(1)->appends(request()->query());
        $maxprice = floor(Product::max('net_price'))+1;
        $minprice = floor(Product::min('net_price'));
        return view('client.search',compact('value','brands','categories','products','searchbrand','searchcategory','minprice','maxprice'));
    }

    public function newProducts(Request $request){
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
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('parent_id','<>',0)->get();
       $newproducts = Product::with('images')->where('status',1)->orderBy('created_at','desc');
        if ($searchbrand) {
            $newproducts = $newproducts->whereHas('brand', function ($q) use ($searchbrand){
                $q->whereIn('brands.alias',$searchbrand);
            });
        }
        if ($searchcategory) {
            $newproducts = $newproducts->whereHas('category', function ($q) use ($searchcategory){
                $q->whereIn('categories.alias',$searchcategory);
            });
        }
        if ($value) {
            $newproducts = $newproducts->where('title','like','%'.$value.'%');
        }
        if ($minprice) {
            $newproducts = $newproducts->where('net_price','>=',$minprice);
        }
        if ($maxprice) {
            $newproducts = $newproducts->where('net_price','<=',$maxprice);
        }
        if ($request->choosetype) {
            if ($request->choosetype=='hightolow') {
                $newproducts->orderBy('net_price','desc');
            }else{
                $newproducts->orderBy('net_price','asc');
            }
        }
        $newproducts = $newproducts->paginate(1)->appends(request()->query());
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('parent_id','<>',0)->get();
        $minprice = floor(Product::min('net_price'));
        $maxprice = floor(Product::max('net_price'))+1;
        return view('client.new-products',compact('newproducts','brands','categories','minprice','maxprice'));
    }

    public function page($alias){
        $page = Page::where('alias',$alias)->first();
        if ($page) {
            return view('client.page.index',compact('page'));
        }
        abort('404');
    }
}
