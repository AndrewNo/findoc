<?php

namespace App\Http\Controllers;

use App\Models\Payer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id = DB::table('payers')->insertGetId(array(
            'title' => $request->payer_title

        ));

        $payer = Payer::find($id);


        return $payer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payer $payer
     * @return \Illuminate\Http\Response
     */
    public function show(Payer $payer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payer $payer
     * @return \Illuminate\Http\Response
     */
    public function edit(Payer $payer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Payer $payer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payer $payer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payer $payer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payer $payer)
    {
        //
    }
}
