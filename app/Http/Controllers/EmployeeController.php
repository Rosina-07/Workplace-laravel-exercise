<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function all()
    {
        return response()->json([
            'message' => 'Employees returned',
            'data' => Employee::with(['contract', 'certifications'])->get()->makeHidden(['start_date', 'contract_id']),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|string',
            'age' => 'required|integer',
            'start_date' => 'required|date',
            'contract_id' => 'required|integer|exists:contracts,id',
            'certification_ids' => 'required|array',
            'certification_ids.*' => 'integer|exists:certifications,id',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->age = $request->age;
        $employee->start_date = $request->start_date;
        $employee->contract_id = $request->contract_id;

        $saved = $employee->save();

        $employee->certifications()->attach($request->certification_ids);

        if (! $saved) {
            return response()->json(['message' => 'Could not add employee'], 500);
        }

        return response()->json(['message' => 'Employee added'], 201);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|string',
            'age' => 'required|integer',
            'start_date' => 'required|date',
            'contract_id' => 'required|integer|exists:contracts,id',
        ]);

        $employee = Employee::find($id);

        $employee->name = $request->name;
        $employee->age = $request->age;
        $employee->start_date = $request->start_date;
        $employee->contract_id = $request->contract_id;

        if (! $employee->save()) {
            return response()->json(['message' => 'Could not update employee details'], 500);
        }

        return response()->json(['message' => 'Employee updated']);
    }

    public function delete(int $id)
    {
        $employee = Employee::find($id);

        if (! $employee) {
            return response('Error invalid product id');
        }

        $employee->delete();

        return response('Employee deleted');
    }
}
