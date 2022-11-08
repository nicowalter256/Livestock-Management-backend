<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expenses;
use App\Models\Milk;


class AnalyticsController extends Controller
{
    public function getIncomes()
    {
        $data = [
            "total_income_amount" =>  Income::sum('amount_earned'),
            "total_expense_amount" => Expenses::sum('amount_spent'),
        ];
        return response()->json($data);
    }


    public function getMilk()
    {
        $data = Milk::get(['total_milk', 'id']);
        return response()->json($data);
    }
}
