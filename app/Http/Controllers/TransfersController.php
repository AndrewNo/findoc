<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::where('is_active', '=', 1)->get();
        $transfers = Transfer::all();

        return view('transfers.index', [
            'accounts' => $accounts,
            'transfers' => $transfers
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

        $transfer = new Transfer();
        $transfer->account_from = $request->account_from;
        $transfer->account_to = $request->account_to;
        $transfer->total_sum = $request->total_sum;
        $transfer->currency = $request->currency;

        $transfer->save();

        $account_from = Account::find($request->account_from);
        $account_from->total_sum = $account_from->total_sum - $request->total_sum;
        $account_from->save();

        $account_to = Account::find($request->account_to);
        $account_to->total_sum = $account_to->total_sum + $request->total_sum;
        $account_to->save();

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        $accounts = Account::where('is_active', '=', 1)->get();

        return view('transfers.edit', [
            'transfer' => $transfer,
            'accounts' => $accounts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Transfer $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {

        if ($request->account_from != $transfer->account_from) {
            $account = Account::find($transfer->account_from);
            $account->total_sum = $account->total_sum + $transfer->total_sum;
            $account->save();

            $account_from = Account::find($request->account_from);
            $account_from->total_sum = $account_from->total_sum - $request->total_sum;
            $account_from->save();
        }

        if ($request->account_to != $transfer->account_to) {
            $account = Account::find($transfer->account_to);
            $account->total_sum = $account->total_sum - $transfer->total_sum;
            $account->save();

            $account_to = Account::find($request->account_to);
            $account_to->total_sum = $account_to->total_sum + $request->total_sum;
            $account_to->save();
        }

        if ($request->account_to == $transfer->account_to && $request->account_from == $transfer->account_from) {
            $account_from = Account::find($request->account_from);
            $account_from->total_sum = $account_from->total_sum + $transfer->total_sum;
            $account_from->total_sum = $account_from->total_sum - $request->total_sum;
            $account_from->save();

            $account_to = Account::find($request->account_to);
            $account_to->total_sum = $account_to->total_sum - $transfer->total_sum;
            $account_to->total_sum = $account_to->total_sum + $request->total_sum;
            $account_to->save();
        }

        $transfer->account_from = $request->account_from;
        $transfer->account_to = $request->account_to;
        $transfer->total_sum = $request->total_sum;
        $transfer->currency = $request->currency;

        $transfer->save();

        return redirect('/transfers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $account_from = Account::find($transfer->account_from);
        $account_from->total_sum = $account_from->total_sum + $transfer->total_sum;
        $account_from->save();

        $account_to = Account::find($transfer->account_to);
        $account_to->total_sum = $account_to->total_sum - $transfer->total_sum;
        $account_to->save();

        $transfer->delete();

        return back();
    }
}
