<?php

namespace FluentPlugin\App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller 
{
    public function index()
    {
        return Doctor::all();
    }

    public function show($id)
    {
        return Doctor::find($id);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username'=> 'required|unique:doctors',
                'password'=> 'required',
                'email'=>'required|unique:doctors',
                'name'=>'required',
            ]);

            $doctor = new Doctor($request->all());
            $doctor->password = Hash::make($request->password);
            $doctor->save();

            return response()->json($doctor, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request,$id)
    {
        $doctor=Doctor::findOrFail($id);
        $doctor->update($request->all());
        return response()->json($doctor,200);
    }

    public function destroy($id)
    {
        Doctor::findOrFail($id)->delete();
        return response()->json(null,204);
    }

    public function filterBySpeciality($speciality)
    {
        return Doctor::where('speciality',$speciality)->get();
    }
    

}