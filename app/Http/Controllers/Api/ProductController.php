<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;

class ProductController extends Controller
{

    public function getAll()
    {
        try {
            $products = Product::where('status', 1)->get();
            if ($products) {
                return jsonize($products, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProduct()
    {
        try {
            $product_id = request()->product_id;
            $product = Product::find($product_id);
            if ($product) {
                return jsonize($product, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getNewestProducts()
    {
        try {
            $newestProducts = Product::where('status', 1)->latest()->limit(10)->get();
            if ($newestProducts) {
                return jsonize($newestProducts, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProductByCategory()
    {
        try {
            $cat_id = request()->category_id;
            $productsByCategory = Product::where('cat_id', $cat_id)->with('images')->where('status', 1)->get();
            if ($productsByCategory) {
                return jsonize($productsByCategory, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProductByBrand()
    {
        try {
            $brand_id = request()->brand_id;
            $productsByBrand = Product::where('brand_id', $brand_id)->where('status', 1)->get();
            if ($productsByBrand) {
                return jsonize($productsByBrand, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProductByPriceRange()
    {
        try {
            $start_price = request()->has('start_price') && request()->start_price != null ? request()->start_price : 0;
            $end_price = request()->has('end_price') && request()->end_price != null ? request()->end_price : 0;
            $productsByPriceRange = Product::whereBetween('price', [$start_price, $end_price])->where('status', 1)->get();
            if ($productsByPriceRange) {
                return jsonize($productsByPriceRange, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProductBySearchKey()
    {
        try {
            $search_query = request()->search_query;
            $key = "%" . $search_query . '%';

            $productsBySearchKey = Product::where(function ($query) use ($key) {
                $query->where('title', 'like', $key)
                    ->orWhere('alias', 'like', $key)
                    ->orWhere('short_text', 'like', $key)
                    ->orWhere('description', 'like', $key);
            })->where('status', 1)->get();

            if ($productsBySearchKey) {
                return jsonize($productsBySearchKey, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getMostLikedProducts()
    {
        try {
            $mostLikedProducts = Product::where('most_liked', 1)->where('status', 1)->latest()->limit(10)->get();
            if ($mostLikedProducts) {
                return jsonize($mostLikedProducts, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getFlashSales()
    {
        try {
            $flashSales = Product::where('flash_sale', 1)->where('status', 1)->latest()->limit(10)->get();
            if ($flashSales) {
                return jsonize($flashSales, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getTopSales()
    {
        try {
            $topSales = Product::where('top_sales', 1)->where('status', 1)->latest()->limit(10)->get();
            if ($topSales) {
                return jsonize($topSales, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getSpecialProducts()
    {
        try {
            $specialProducts = Product::where('special_deals', 1)->where('status', 1)->latest()->limit(10)->get();
            if ($specialProducts) {
                return jsonize($specialProducts, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getJustForYouProducts()
    {
        try {
            $justForYouProducts = Product::where('just_for_you', 1)->where('status', 1)->latest()->limit(10)->get();
            if ($justForYouProducts) {
                return jsonize($justForYouProducts, true, 200);
            }
            return jsonize([], false, 500);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getProductDetail($id){
       try {
            $product = Product::with(['images','brand','category'])->whereId($id)->first();
            $relatedProducts = Product::where([['cat_id',$product->cat_id],['brand_id',$product->brand_id],['id','!=',$product->id]])->with('images')->orderBy('id','desc')->take(4)->get();
            if ($product) {
                $data = [
                    'product'           =>  $product,
                    'relatedProducts'   =>  $relatedProducts
                ];
                return jsonize($data, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function filterProducts(){
        try {
            $products = Product::where('status', 1);
            if (request()->search_query && request()->search_query!='') {
                $search_query = request()->search_query;
                $key = "%" . $search_query . '%';
                $products = $products->where(function ($query) use ($key) {
                        $query->where('title', 'like', $key)
                            ->orWhere('alias', 'like', $key)
                            ->orWhere('short_text', 'like', $key)
                            ->orWhere('description', 'like', $key);
                    });
            }
            if (request()->start_price && request()->start_price != '') {
                $products = $products->where('price', '>=', request()->start_price);
            }
            if (request()->end_price && request()->end_price != '') {
                $products = $products->where('price', '<=', request()->end_price);
            }
            if (request()->category && request()->category != '') {
                $products = $products->whereIn('cat_id',request()->category);
            }
            if (request()->brand && request()->brand != '') {
                $products = $products->whereIn('brand_id', request()->brand);
            }
            $products = $products->with('images')->get();
            if ($products) {
                return jsonize($products, true, 200);
            }
            return jsonize([], true, 200);
        }catch (\Exception $e) {
            return jsonize(['error' => $e. ""], false, 500);
        }
    }

    public function filterInfo() {
        try {
            $categories = Category::where('parent_id','<>',0)->get();

            $brands = Brand::where('status', '1')->get();

            $data = [
                'category' => $categories,
                'brand' => $brands
            ];

            if ($data) {
                return jsonize($data, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function filterMore($type) {
        try {
            $product = Product::where('status', 1);
            if ($type == 2) {
                $data = $product->where('most_liked', 1)->where('status', 1)->latest()->limit(10)->get();
            } else if ($type == 3) {
                $data = $product->where('flash_sale', 1)->where('status', 1)->latest()->limit(10)->get();
            } else if ($type == 4) {
                $data = $product->where('top_sales', 1)->where('status', 1)->latest()->limit(10)->get();
            } else if ($type == 5) {
                $data = $product->where('special_deals', 1)->where('status', 1)->latest()->limit(10)->get();
            } else if ($type == 6) {
                $data = $product->where('just_for_you', 1)->where('status', 1)->latest()->limit(10)->get();
            }

            if ($data) {
                return jsonize($data, true, 200);
            }
            return jsonize([], false, 404);
        }
        catch(\Exception $e) {
            return jsonize([], false, 500);
        }
    }
}
