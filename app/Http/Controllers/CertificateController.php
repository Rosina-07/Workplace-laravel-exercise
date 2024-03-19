<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function find(int $id)
    {
        $certificate = Certification::with('employees')->find($id);

        return response()->json(['message' => 'certificate returned',
            'data' => $certificate]);
    }

    public function create(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100',
            'description' => 'required|string|max:300']);

        $certificate = new Certification();
        $certificate->name = $request->name;
        $certificate->description = $request->description;

        if (! $certificate->save()) {
            return response()->json(['message' => 'Certificate not created'], 500);
        }

        return response()->json(['message' => 'Certificate created'], 201);
    }
}
