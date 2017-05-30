<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Outcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /*Incomes kostulno*/
        $all_incomes = Income::all();

        $income_total_sum = 0;
        $incomes_by_cat =[];
        $income_trend = [];
        foreach ($all_incomes as $income) {
            $income_total_sum += $income->total_sum;
            $incomes_by_cat[$income->category->title] = 0;
            $income_trend[] = [Carbon::parse($income->created_at)->format('d-M-Y'), $income->total_sum];
        }

        foreach ($all_incomes as $income) {
            foreach ($incomes_by_cat as $key => $item) {
                if ($key == $income->category->title) {
                    $incomes_by_cat[$key] += $income->total_sum;
                }
            }
        }

        foreach ($incomes_by_cat as $key => $value) {
            $incomes_by_cat[$key] = $value/$income_total_sum;
        }

        $incomes = [];

        foreach ($incomes_by_cat as $key => $value) {
            $incomes[] = [$key, $value];
        }

        $incomes = json_encode($incomes);
        $income_trend = json_encode($income_trend);


        /*Outcomes kostulno*/
        $all_outcomes = Outcome::all();

        $outcome_total_sum = 0;
        $outcomes_by_cat =[];
        foreach ($all_outcomes as $outcome) {
            $outcome_total_sum += $outcome->total_sum;
            $outcomes_by_cat[$outcome->category->title] = 0;
        }

        foreach ($all_outcomes as $outcome) {
            foreach ($outcomes_by_cat as $key => $item) {
                if ($key == $outcome->category->title) {
                    $outcomes_by_cat[$key] += $outcome->total_sum;
                }
            }
        }

        foreach ($outcomes_by_cat as $key => $value) {
            $outcomes_by_cat[$key] = $value/$outcome_total_sum;
        }

        $outcomes = [];

        foreach ($outcomes_by_cat as $key => $value) {
            $outcomes[] = [$key, $value];
        }


        $outcomes = json_encode($outcomes);

        return view('index', ['incomes' => $incomes, 'income_trend' => $income_trend, 'outcomes' => $outcomes]);
    }
}
