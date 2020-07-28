<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Models\Rate;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rates = Rate::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.superadmin.rates.rates_index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.superadmin.rates.rates_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'rate_name' => 'required',
            'rate_type' => 'required',
            'rate_value' => 'required'
        ]);

        $rate = new Rate;
        $rate->rate_name = $request->input('rate_name');
        $rate->rate_type = $request->input('rate_type');
        if ($request->input('rate_type') == '1') {
            $rate->rate_value = $request->input('rate_value');
        } else {
            $rate->rate_value = $request->input('rate_value') / 100;
        }
        if ($request->input('expiry_date') != NULL)
        {
            $rate->expiry_date = $request->input('expiry_date');
        }
        $rate->admin_name = Auth()->User()->name;
        $rate->save();
        return redirect(route('rates.index'))->with('success','Rate Created');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rate = Rate::find($id);
        $rate->delete();
        return redirect(route('rates.index'))->with('success', 'Rate Deleted');
    }
}
