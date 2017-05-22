<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Income;
use App\Models\Payer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $incomes = Income::whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])->get();

        $categories = Category::where('type', '=', 'income')->get();

        $payers = Payer::all();

        $accounts = Account::where('is_active', '=', 1)->get();

        return view('incomes.index', [
            'incomes' => $incomes,
            'categories' => $categories,
            'payers' => $payers,
            'accounts' => $accounts,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $income = new Income();

        if(isset($request->date) && !empty($request->date)) {
            $income->created_at = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        }

        $income->category_id = $request->category_id;
        $income->account_id = $request->account_id;
        $income->payer_id = $request->payer_id;
        $income->total_sum = $request->total_sum;
        $income->currency = $request->currency;
        $income->comment = $request->comment;

        $income->save();

        $account = Account::find($request->account_id);

        $account->total_sum = $account->total_sum + $request->total_sum;

        $account->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $categories = Category::where('type', '=', 'income')->get();

        $payers = Payer::all();

        $accounts = Account::where('is_active', '=', 1)->get();

        return view('incomes.edit', [
            'income' => $income,
            'categories' => $categories,
            'payers' => $payers,
            'accounts' => $accounts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Income $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        if ($income->account_id == $request->account_id) {
            $account = Account::find($income->account_id);

            $account->total_sum = ($account->total_sum - $income->total_sum) + $request->total_sum;

            $account->save();
        } else {


            $account = Account::find($request->account_id);
            $account->total_sum = $account->total_sum + $request->total_sum;
            $account->save();

            if ($income->total_sum != $account->total_sum) {
                $prev_account = Account::find($income->account_id);
                $prev_account->total_sum = $prev_account->total_sum - $income->total_sum;
                $prev_account->save();
            } else {
                $prev_account = Account::find($income->account_id);
                $prev_account->total_sum = $prev_account->total_sum - $request->total_sum;
                $prev_account->save();
            }

        }

        $income->category_id = $request->category_id;
        $income->account_id = $request->account_id;
        $income->payer_id = $request->payer_id;
        $income->total_sum = $request->total_sum;
        $income->currency = $request->currency;
        $income->comment = $request->comment;
        $income->save();

        return redirect('incomes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income $income
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Income $income)
    {
        $account = Account::find($income->account_id);

        $account->total_sum = $account->total_sum - $income->total_sum;

        $account->save();


        $income->delete();
        return back();
    }

    public function getByDate(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $date_arr = explode('-', $date);
        $next = Carbon::create($date_arr[0], $date_arr[1], substr($date_arr[2], 0, 2), 0, 0, 0);

        $incomes = Income::whereBetween('created_at', [$date, $next->endOfDay()->format('Y-m-d H:i:s')])->get();


        return view('incomes/bydate', ['incomes' => $incomes]);
    }
}
