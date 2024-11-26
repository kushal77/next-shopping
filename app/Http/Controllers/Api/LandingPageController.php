<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Category;
use App\Model\Product;

class LandingPageController extends Controller
{

    public function getAllData()
    {
        try {
            $banners = Banner::where('status', 1)->get();

            $flashSales = Product::where('flash_sale', 1)->where('status', 1)->latest()->with('images')->limit(10)->get();

            $categories = Category::where('parent_id','<>',0)->get();

            $newestProducts = Product::where('status', 1)->latest()->limit(10)->with('images')->get();

            $topSales = Product::where('top_sales', 1)->where('status', 1)->with('images')->latest()->limit(10)->get();

            $mostlikes = Product::where('most_liked',1)->where('status',1)->with('images')->latest()->limit(10)->get();

            $specialProducts = Product::where('special_deals', 1)->where('status', 1)->with('images')->latest()->limit(10)->get();

            $justForYouProducts = Product::where('just_for_you', 1)->where('status', 1)->with('images')->latest()->limit(10)->get();

            $data = [
                'banners' => $banners,
                'flashSales' => $flashSales, 
                'categories' => $categories,
                'newest' => $newestProducts,
                'topSales' => $topSales,
                'mostLikes' => $mostlikes,
                'special' => $specialProducts,
                'justForYou' => $justForYouProducts
            ];
            
            if ($data) {
                return jsonize($data, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }

    }

}
