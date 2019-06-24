<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Budget;

class BudgetController extends Controller
{
    public function index() {
        return response()->json([
            'ok' => true,
        ], Response::HTTP_OK);
    }

    public function show(Budget $budget) {
        return response()->json([
            'data' => $budget,
        ], Response::HTTP_OK);
    }
}
