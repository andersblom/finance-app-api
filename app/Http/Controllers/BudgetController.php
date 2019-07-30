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
        ]);
    }

    public function show(Budget $budget) {
        $this->authorize('view', $budget);

        return response()->json([
            'data' => $budget,
        ]);
    }

    public function store(Request $request) {
        $budget = Budget::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => $request->user()->id,
        ]);
        return response()->json($budget);
    }

    public function update(Budget $budget, Request $request) {
        $this->authorize('update', $budget);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $budget->name = $request->name;
        $budget->slug = $request->slug;
        $budget->save();

        return response()->json($budget);
    }

    public function destroy(Budget $budget) {
        $this->authorize('delete', $budget);
        $budget->delete();

        return response()->json($budget);
    }
}
