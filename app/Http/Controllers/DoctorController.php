<?php

namespace FluentPlugin\App\Http\Controllers;

use FluentPlugin\App\Models\Doctor;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use FluentPlugin\Framework\Request\Request;

class DoctorController extends Controller 
{
    public function index(Request $request)
    {
        $search = sanitize_text_field( $request->get('search') );
        $query = Doctor::query();

        if (!empty($search)) {
            $query = $query->where('speciality', $search);
        }
        $query = $query->get();

        return [
            'doctors' => $query
        ];
    }

    public function show($id)
    {
        return Doctor::find($id);
    }

    public function store(Request $request)
    {
       
         $doctor = $request->get('doctors');
        try {
            // $doctor->validate([
            //     'username'=> 'required|unique',
            //     'password'=> 'required',
            //     'email'=>'required',
            //     'name'=>'required',
            // ]);

            // $doctor = new Doctor($request->all());
            // $data = [
            //     'username' => 
            //      'password',
            //       'email', 
            //       '',
            //        'specialty',
            //         'contact_info'
                    
            // ];
            // $doctor->password = $request->password;
            $data = [
                'username' => $doctor['username'],
                'email' => $doctor['email'],
                'name' => $doctor['name'],
                'contact_info' => $doctor['contact_info'],
                'speciality' => $doctor['speciality']
            ];
            Doctor::create($data);
            $allDoctors = Doctor::query()->get();
            
            return [
                'message' => 'success',
                'doctors' => $allDoctors
            ];
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request,$id)
    {
        $doctor=Doctor::findOrFail($id);
        $doctor->update($request->all());
        return [
            'message' => __('Doctor Updated Successfully')
        ];
       
    }

    public function destroy($id)
    {
        
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();

            return [
                'message' => __('Doctor Deleted Successfully')
            ];
    }

    public function filterBySpeciality($speciality)
    {
        return Doctor::where('speciality',$speciality)->get();
    }
    

}