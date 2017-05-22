<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Outcome;
use App\Models\Seller;
use App\Models\Subcategory;
use Carbon\Carbon;
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
        $outcomes = Outcome::whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])->get();

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

        if(isset($request->date) && !empty($request->date)) {
            $outcome->created_at = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        }

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


        if ($outcome->account_id == $request->account_id) {
            $account = Account::find($outcome->account_id);


            $account->total_sum = ($account->total_sum + $outcome->total_sum) - $request->total_sum;

            $account->save();
        } else {


            $account = Account::find($request->account_id);
            $account->total_sum = $account->total_sum - $request->total_sum;
            $account->save();

            if ($outcome->total_sum != $account->total_sum) {
                $prev_account = Account::find($outcome->account_id);
                $prev_account->total_sum = $prev_account->total_sum + $outcome->total_sum;
                $prev_account->save();
            } else {
                $prev_account = Account::find($outcome->account_id);
                $prev_account->total_sum = $prev_account->total_sum + $request->total_sum;
                $prev_account->save();
            }

        }

        $outcome->category_id = $request->category_id;
        $outcome->subcategory_id = $request->subcategory_id;
        $outcome->account_id = $request->account_id;
        $outcome->seller_id = $request->seller_id;
        $outcome->total_sum = $request->total_sum;
        $outcome->currency = $request->currency;
        $outcome->comment = $request->comment;
        $outcome->save();

        return redirect('outcomes');

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

    public function getByDate(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $date_arr = explode('-', $date);
        $next = Carbon::create($date_arr[0], $date_arr[1], substr($date_arr[2], 0, 2), 0, 0, 0);

        $outcomes = Outcome::whereBetween('created_at', [$date, $next->endOfDay()->format('Y-m-d H:i:s')])->get();


        return view('outcomes/bydate', ['outcomes' => $outcomes]);
    }
}
