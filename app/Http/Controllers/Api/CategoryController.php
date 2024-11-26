<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Category;

class CategoryController extends Controller
{

    public function getAll()
    {
        try {
            $categories = Category::where('parent_id', 0)->get();
            if ($categories) {
                return jsonize($categories, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getChildren()
    {
        try {
            $parent_id = request()->parent_id;
            $childCategories = Category::where('parent_id', $parent_id)->get();
            if ($childCategories) {
                return jsonize($childCategories, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getCategory()
    {
        try {
            $cat_id = request()->category_id;
            $category = Category::find($cat_id);
            if ($category) {
                return jsonize($category, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }
}
