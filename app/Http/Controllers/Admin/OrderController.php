<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::orderby('created_at', 'DESC');
        if($request->order=='completed'){
            $orders = $orders->where('status',2);
        }elseif($request->order=='shipped'){
            $orders = $orders->where('status',1);
        }if($request->order=='pending'){
            $orders = $orders->where('status',0);
        }
        $orders = $orders->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('detail','user')->whereId($id)->first();
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request,$id){
        Order::whereId($id)->update($request->except(['_token','_method']));
        return response()->json(['success'=>'Selected Order has been successfully updated.']);
    }
}
