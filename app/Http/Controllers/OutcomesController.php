<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Outcome;
use App\Models\Seller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class OutcomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcomes = Outcome::all();

        $accounts = Account::where('is_active', '=', 1)->get();

        $categories = Category::where('type', '=', 'outcome')->get();

        $subcategories = Subcategory::all();

        $sellers = Seller::all();


        return view('outcomes.index', [
            'outcomes' => $outcomes,
            'accounts' => $accounts,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'sellers' => $sellers,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $outcome = new Outcome();
        $outcome->category_id = $request->category_id;
        $outcome->subcategory_id = $request->subcategory_id;
        $outcome->account_id = $request->account_id;
        $outcome->seller_id = $request->seller_id;
        $outcome->total_sum = $request->total_sum;
        $outcome->currency = $request->currency;
        $outcome->comment = $request->comment;
        $outcome->save();

        $account = Account::find($request->account_id);
        $account->total_sum = $account->total_sum - $request->total_sum;
        $account->save();

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {

        $accounts = Account::where('is_active', '=', 1)->get();

        $categories = Category::where('type', '=', 'outcome')->get();

        $subcategories = Subcategory::where('category_id', '=', $outcome->category_id)->get();

        $sellers = Seller::all();

        return view('outcomes.edit', [
            'outcome' => $outcome,
            'accounts' => $accounts,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'sellers' => $sellers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcome $outcome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcome $outcome)
    {
        $account = Account::find($outcome->account_id);

        $account->total_sum = $account->total_sum + $outcome->total_sum;

        $account->save();


        $outcome->delete();
        return back();
    }
}
