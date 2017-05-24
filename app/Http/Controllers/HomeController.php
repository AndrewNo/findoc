<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $incomes = Income::all();

        $total_sum = 0;

        foreach ($incomes as $income) {
            $total_sum += $income->total_sum;
        }
        $data = [];

        foreach ($incomes as $income) {
            $data[] = [$income->category->title, $income->total_sum/$total_sum];
        }

        $data = json_encode($data);

        return view('index', ['data' => $data]);
    }
}
