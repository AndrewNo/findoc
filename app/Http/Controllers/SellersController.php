<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();

        return view('sellers.index', ['sellers' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = DB::table('sellers')->insertGetId(array(
            'title' => $request->seller_title

        ));

        $payer = Seller::find($id);


        return $payer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        return view('sellers.edit', ['seller' => $seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        $seller->title = $request->seller_title;
        $seller->save();

        return redirect('sellers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $outcomes = Outcome::where('seller_id', '=', $seller->id)->get();
        foreach ($outcomes as $outcome) {
            $outcome->seller_id = null;
            $outcome->save();
        }

        $seller->delete();

        return back();
    }
}
