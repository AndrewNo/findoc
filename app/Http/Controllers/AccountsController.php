<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Debt;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Transfer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request_api = new Client();
        $response = $request_api->get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json', ['verify' => false])->getBody();

        $currencies = json_decode($response);
        $accounts = Account::all();

        return view('accounts.index', [
            'currencies' => $currencies,
            'accounts' => $accounts
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

        $account = new Account();
        $account->title = $request->title;
        $account->total_sum = $request->total_sum;
        $account->currency = $request->currency;
        $account->pic = $request->pic;

        $account->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $request_api = new Client();
        $response = $request_api->get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json', ['verify' => false])->getBody();

        $currencies = json_decode($response);

        return view('accounts.edit', [
            'account' =>$account,
            'currencies' => $currencies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $account->title = $request->title;
        $account->total_sum = $request->total_sum;
        $account->currency = $request->currency;
        $account->pic = $request->pic;

        $account->save();

        return redirect('/accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {

        $incomes = Income::where('account_id', '=', $account->id)->get();
        foreach ($incomes as $income) {
            $income->delete();
        }
        $outcomes = Outcome::where('account_id', '=', $account->id)->get();
        foreach ($outcomes as $outcome) {
            $outcome->delete();
        }
        $transfers = Transfer::where('account_to', '=', $account->id)->get();
        foreach ($transfers as $transfer) {
            $transfer->delete();
        }
        $debts = Debt::where('account_id', '=', $account->id)->get();
        foreach ($debts as $debt) {
            $debt->delete();
        }

        $account->delete();

        return back();
    }

    public function nonActive(Request $request)
    {

        $account = Account::find($request->id);

        if ($request->active  == 'true') {
            $account->is_active = 1;
        }else {
            $account->is_active = 0;
        }

        $account->save();

        return back();
    }
}
