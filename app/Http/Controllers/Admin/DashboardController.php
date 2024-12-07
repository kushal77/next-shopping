<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Order;

class DashboardController extends Controller{
    public function index(){
    	$customers = User::where('type',2)->count();
        $products = Product::count();
        $categories = Category::count();
        $brands =Brand::count();
        $totalcompleted = Order::count();
        $ordercompleted = Order::where('status',2)->count();
        $ordershipped = Order::where('status',1)->count();
        $orderpending = Order::where('status',0)->count();
        return view('admin.dashboard',compact('customers','products','categories','brands','ordercompleted','ordershipped','orderpending','totalcompleted'));
    }
}