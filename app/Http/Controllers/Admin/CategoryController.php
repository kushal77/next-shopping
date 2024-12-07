<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('created_at', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCats = Category::where('parent_id',0)->pluck('title','id')->toArray();
        return view('admin.category.add',compact('parentCats'));
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
            'image' => 'required',
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'status' => 'required',
            'customfield.*.label' => 'required',
            'customfield.*.fieldtype' => 'required'
        ]);
        $data = $request->all();
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category'), $new_name);
            $data['image'] = $new_name;
        }
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        if (!$request->parent_id) {
            $data['parent_id']=0;
        }
        $data['customfields'] = json_encode($request->customfield);
        Category::create($data);
        return redirect()->back()->withSuccess('Category has been successfully created.');
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
        $parentCats = Category::where('parent_id',0)->pluck('title','id')->toArray();
        $category = Category::whereId($id)->first();
        return view('admin.category.edit', compact('category','parentCats'));
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
            'metatitle' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'status' => 'required',
            'customfield.*.label' => 'required',
            'customfield.*.fieldtype' => 'required'
        ]);
        $data = $request->except(['_token','_method','metatitle','metakey','metadesc','customfield']);
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        $image = $request->file('image');
        if($image != ''){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category'), $new_name);
            $data['image'] = $new_name;
        }
        $data['seo'] = json_encode([
            'metatitle'     => $request->metatitle,
            'metakey'       => $request->metakey,
            'metadesc'      => $request->metadesc,
        ]);
        if (!$request->parent_id) {
            $data['parent_id']=0;
        }
        $data['customfields'] = json_encode($request->customfield);
        Category::whereId($id)->update($data);
        return redirect()->back()->withSuccess('Selected Category has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = Product::where('cat_id',$request->user_id)->get();
        foreach($products as $product){
            $prod = Product::find($product->id);
            $prod->status = StatusEnum::Unpublished;
            $prod->save();
        }
        $category = Category::find($request->user_id);
        $category->status = StatusEnum::Unpublished;
        $category->save();
        return redirect()->back()->withSuccess('Selected Category has been successfully deleted.');
    }

    public function customfields(Request $request){
        $category = Category::whereId($request->catId)->pluck('customfields')->first();
        $html = '';
        if ($category!="null") {
            $html.=view('admin.category.customfields',compact('category'))->render();
        }
        return response()->json(['html'=>$html]);
    }

    public function loadcustomfields(Request $request){
        $product = Product::whereId($request->productId)->first();
        $html = '';
        if($product){
            $category = Category::whereId($request->catId)->pluck('customfields')->first();
            $html.=view('admin.category.loadcustomfields',compact('category','product'))->render();
        }
        return response()->json(['html'=>$html]);
    }
}
