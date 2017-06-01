<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Income;
use App\Models\Outcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /*Incomes kostulno*/
        $all_incomes = Income::withTrashed()->orderBy('created_at', 'asc')->get();

        $income_total_sum = 0;
        $incomes_by_cat = [];
        $income_trend = [];
        $d = [];
        foreach ($all_incomes as $income) {
            $income_total_sum += $income->total_sum;
            $incomes_by_cat[$income->category->title] = 0;
            $d[Carbon::parse($income->created_at)->format('d-M-Y')] = 0;
        }

        foreach ($all_incomes as $income) {
            foreach ($incomes_by_cat as $key => $item) {
                if ($key == $income->category->title) {
                    $incomes_by_cat[$key] += $income->total_sum;
                }
            }

            foreach ($d as $key => $item) {
                if ($key == Carbon::parse($income->created_at)->format('d-M-Y')) {
                    $d[$key] += $income->total_sum;
                }
            }
        }

        foreach ($d as $key => $value) {
            $income_trend[] = [$key, $value];
        }


        foreach ($incomes_by_cat as $key => $value) {
            $incomes_by_cat[$key] = $value / $income_total_sum;
        }

        $incomes = [];

        foreach ($incomes_by_cat as $key => $value) {
            $incomes[] = [$key, $value];
        }

        $incomes = json_encode($incomes);
        $income_trend = json_encode($income_trend);




        /*Outcomes kostulno*/
        $all_outcomes = Outcome::withTrashed()->orderBy('created_at', 'asc')->get();

        $outcome_total_sum = 0;
        $outcomes_by_cat = [];
        $outcomes_by_date = [];
        $outcome_trend = [];
        foreach ($all_outcomes as $outcome) {
            $outcome_total_sum += $outcome->total_sum;
            $outcomes_by_cat[$outcome->category->title] = 0;
            $outcomes_by_date[Carbon::parse($outcome->created_at)->format('d-M-Y')] = 0;
        }

        foreach ($all_outcomes as $outcome) {
            foreach ($outcomes_by_cat as $key => $item) {
                if ($key == $outcome->category->title) {
                    $outcomes_by_cat[$key] += $outcome->total_sum;
                }
            }
            foreach ($outcomes_by_date as $key => $item) {
                if ($key == Carbon::parse($outcome->created_at)->format('d-M-Y')) {
                    $outcomes_by_date[$key] += $outcome->total_sum;
                }
            }
        }

        foreach ($outcomes_by_cat as $key => $value) {
            $outcomes_by_cat[$key] = $value / $outcome_total_sum;
        }

        $outcomes = [];

        foreach ($outcomes_by_cat as $key => $value) {
            $outcomes[] = [$key, $value];
        }

        foreach ($outcomes_by_date as $key => $value) {
            $outcome_trend[] = [$key, $value];
        }

        $outcomes = json_encode($outcomes);
        $outcome_trend = json_encode($outcome_trend);

        $accounts = Account::withTrashed()->get();

        return view('index', [
            'incomes' => $incomes,
            'income_trend' => $income_trend,
            'outcomes' => $outcomes,
            'outcome_trend' => $outcome_trend,
            'accounts' => $accounts
        ]);
    }

    public function analyzeAccount(Request $request)
    {

        $income_account = Income::withTrashed()->where('account_id', '=', $request->account_id)->get();
        $outcome_account = Outcome::withTrashed()->where('account_id', '=', $request->account_id)->get();


        $income_total_sum = 0;
        foreach ($income_account as $item) {
            $income_total_sum += $item->total_sum;
        }

        $outcome_total_sum = 0;
        foreach ($outcome_account as $item) {
            $outcome_total_sum += $item->total_sum;
        }

        $account_an = [['Income', $income_total_sum, 'green'], ['Outcome', $outcome_total_sum, 'red']];



        return $account_an;
    }
}
