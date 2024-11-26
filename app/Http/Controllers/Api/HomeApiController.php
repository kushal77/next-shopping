<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Exception;

class HomeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        try{
            $banners = Banner::where('status',1)->get();
            $rightbrands = Brand::where('status',1)->get();
            $rightcategories = Category::with('childrens')->where('parent_id',0)->where('status',1)->get();
            $categories = Category::where('parent_id','<>',0)->where('status',1)->get();
            $flashsales = Product::where('flash_sale',1)->where('status',1)->get();
            $newproducts = Product::where('status',1)->orderBy('created_at','desc')->get();
            $topsales = Product::where('top_sales',1)->where('status',1)->get();
            $specials = Product::where('special_deals',1)->where('status',1)->get();
            $mostlikes = Product::where('most_liked',1)->where('status',1)->get();
            $justforyous = Product::where('just_for_you',1)->where('status',1)->get();

            $data = array_add($data, 'banners', $banners);
            $data = array_add($data, 'rightbrands', $rightbrands);
            $data = array_add($data, 'rightcategories', $rightcategories);
            $data = array_add($data, 'categories', $categories);
            $data = array_add($data, 'flashsales', $flashsales);
            $data = array_add($data, 'newproducts', $newproducts);
            $data = array_add($data, 'topsales', $topsales);
            $data = array_add($data, 'specials', $specials);
            $data = array_add($data, 'mostlikes', $mostlikes);
            $data = array_add($data, 'justforyous', $justforyous);

            return jsonize($data, true, 200);
        }catch(\Exception $e){
            return jsonize($data, false, 500);
        }
    }


}
