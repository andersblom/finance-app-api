<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Budget;

class BudgetController extends Controller
{
    public function index(Request $request) {
        return response()->json([
            'data' => $request
                ->user()
                ->budgets()
                ->get(),
        ], Response::HTTP_OK);
    }

    public function show(Budget $budget, Request $request) {
        if ($budget->user_id == $request->user()->id) {
            return response()->json([
                'data' => $budget,
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'You don\'t have access to this budget.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function store(Request $request) {
        $budget = Budget::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => $request->user()->id,
        ]);
        return response()->json($budget, Response::HTTP_OK);
    }
}
