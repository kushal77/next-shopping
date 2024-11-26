<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Banner;

class BannerController extends Controller
{

    public function getAll()
    {
        try {
            $banners = Banner::where('status', 1)->get();
            if ($banners) {
                return jsonize($banners, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }

    }

}
