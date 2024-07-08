<?php

namespace FluentPlugin\App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller 
{
    public function index()
    {
        return Patient::all();
    }

    public function show($id)
    {
        return Patient::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'name' => 'required',
            'email' => 'required|unique:patients',
            'health_condition' => 'required'

        ]);

        $patient = Patient::create($request->all());

        return response()->json($patient,201);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());

        return response()->json($patient, 200);
    }

    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return response()->json(null,204);
    }

    public function filteByHealthCondition($condition)
    {
        return Patient::where('health_condition',$condition)->get();
    }

}