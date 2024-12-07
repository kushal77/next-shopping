<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EmiRate;

class EmiRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emi_rates = EmiRate::orderby('created_at', 'DESC')->get();
        return view('admin.emi_rates.index', compact('emi_rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emi_rates.add');
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
            'months' => 'required',
            'rate' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        EmiRate::create($data);
        return redirect()->back()->withSuccess('Emi Rate has been successfully created.');
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
        $emi_rate = EmiRate::whereId($id)->first();
        return view('admin.emi_rates.edit', compact('emi_rate'));
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
            'months' => 'required',
            'rate'  =>  'required',
            'status' => 'required'
        ]);
        $data = $request->except(['_token','_method']);
        EmiRate::whereId($id)->update($data);
        return redirect()->back()->withSuccess('Selected Emi Rate has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        EmiRate::whereId($request->user_id)->delete();
        return redirect()->back()->withSuccess('Selected Emi Rate has been successfully deleted.');
    }
}
