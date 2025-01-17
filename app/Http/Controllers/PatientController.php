<?php

namespace FluentPlugin\App\Http\Controllers;

use FluentPlugin\App\Models\Patient;
use FluentPlugin\Framework\Request\Request;


class PatientController extends Controller 
{
    public function index(Request $request, $doctorId)
    {
        $search = sanitize_text_field($request->get('health_condition'));
        $query=Patient::where('doctor_id', $doctorId);
        if(!empty($search))
        {
            $query=$query->where('health_condition',$search);
        }
        $query=$query->get();
        return[
            'patients'=>$query
        ];

    }

    public function show($doctorId, $patientId)
    {
        return Patient::where('id', $patientId)
            ->where('doctor_id', $doctorId)
            ->first();
    }
    

    public function store(Request $request,$doctorId)
    {
        $patient = $request->get('patients');
        // $request->validate([
        //     'doctor_id' => 'required|exists:doctors,id',
        //     'name' => 'required',
        //     'email' => 'required|unique:patients',
        //     'health_condition' => 'required'

        // ]);
        // console.log($patient);
        $data = [
        'doctor_id' => $doctorId,
        'name'=> $patient['name'],
        'email'=> $patient['email'], 
        'age'=> $patient['age'], 
        'gender'=> $patient['gender'], 
        'contact_info'=> $patient['contact_info'], 
        'health_condition'=> $patient['health_condition']
        ];

        Patient::create($data);

        $allPatients = Patient::where('doctor_id', $doctorId)->get();

        return[
            'message' => 'success',
            'patients' => $allPatients
        ];

        
    }

    public function update(Request $request, $doctorId, $patientId)
    {
        $patient = Patient::where('id',$patientId)
                          ->where('doctor_id',$doctorId)
                          ->firstOrFail();
        $patient->update($request->all());

        return [
            'message' => __('Patient Updated Successfully')
        ];
    }

    public function destroy($doctorId,$id)
    {
        $patient = Patient::where('id',$id)
                          ->where('doctor_id',$doctorId)
                          ->firstOrFail();
        // $query=Patient::where('doctor_id',$doctorId);
        // $query=$query->where('id',$id);
        // $query->delete();
        $patient->delete();
        return [
            'message' => __('Doctor Deleted Successfully')
        ];
    }

    public function filteByHealthCondition($condition)
    {
        return Patient::where('health_condition',$condition)->get();
    }

}