<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::all();

        return view('agents.index', ['agents' => $agents]);
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
        $id = DB::table('agents')->insertGetId(array(
            'title' => $request->title

        ));

        $agent = Agent::find($id);


        return $agent;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        return view('agents.edit', ['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        $agent->title = $request->seller_title;
        $agent->save();

        return redirect('agents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        $debts = Debt::where('agent_id', '=', $agent->id)->get();
        foreach ($debts as $debt) {
            $debt->agent_id = null;
            $debt->save();
        }

        $agent->delete();

        return back();
    }
}
