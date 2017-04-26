<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }

    public function getCurrency()
    {
        $currency = new Client();
        $response = $currency->get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json', ['verify' => false])->getBody();

        $cur = json_decode($response);

        return $cur;
    }
}
