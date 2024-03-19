<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function all()
    {
        return response()->json([
            'message' => 'Contracts returned',
            'data' => Contract::with('employees:name,contract_id')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|string',
        ]);

        $contract = new Contract();
        $contract->name = $request->name;

        if (! $contract->save()) {
            return response()->json(['message' => 'Could not create contract'], 500);
        }

        return response()->json(['message' => 'contract created'], 201);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|string',
        ]);

        $contract = Contract::find($id);
        $contract->name = $request->name;

        if (! $contract->save()) {
            return response()->json(['message' => 'Could not update contract'], 500);
        }

        return response()->json(['message' => 'contract updated']);
    }
}
