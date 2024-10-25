<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salesperson;

class SalespersonController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required|in:residential,commercial'
        ]);

        $salesperson = Salesperson::create($validated);

        return response()->json(['message' => 'Salesperson successfully created', 'salesperson' => $salesperson]);
    }
    public function penalize(Request $request, $id)
    {
        $salesperson = Salesperson::findOrFail($id);

        $salesperson->update([
            'penalty_start' => $request->input('penalty_start'),
            'penalty_end' =>  $request->input('penalty_end'),
            'is_penalized' =>true
        ]);

        return response()->json(['message' => 'Salesperson penalized', 'salesperson' => $salesperson]);
    }

}
