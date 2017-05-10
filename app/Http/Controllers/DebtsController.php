<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agent;
use App\Models\Debt;
use Illuminate\Http\Request;

class DebtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $accounts = Account::where('is_active', '=', 1)->get();
        $agents = Agent::all();
        $debts = Debt::all();

        return view('debts.index', [
            'accounts' => $accounts,
            'agents' => $agents,
            'debts' => $debts
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

        if ($request->type == 'debit'){
            $account = Account::find($request->account_id);
            $account->total_sum = $account->total_sum + $request->total_sum;
            $account->save();
        }else {
            $account = Account::find($request->account_id);
            $account->total_sum = $account->total_sum - $request->total_sum;
            $account->save();
        }

        $debt = new Debt();
        $debt->account_id = $request->account_id;
        $debt->total_sum = $request->total_sum;
        $debt->currency = $request->currency;
        $debt->type = $request->type;
        $debt->agent_id = $request->agent_id;
        $debt->comment = $request->comment;
        $debt->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {

        $accounts = Account::where('is_active', '=', 1)->get();
        $agents = Agent::all();

        return view('debts.edit', [
            'debt' => $debt,
            'accounts' => $accounts,
            'agents' =>$agents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        if ($debt->type == 'debit') {
            $account = Account::find($debt->account_id);
            $account->total_sum = $account->total_sum - $debt->total_sum;
            $account->save();
        } else {
            $account = Account::find($debt->account_id);
            $account->total_sum = $account->total_sum + $debt->total_sum;
            $account->save();
        }

        $debt->delete();

        return back();
    }
}
