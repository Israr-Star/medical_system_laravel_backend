<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Cardio;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{


    

    public function index(){

        $cardio = Doctor::all();
        return response()->json([
        'status'=>'success',
        'cardio'=> $cardio
        ]);


    }

     function viewCardiologists(Request $request){

        $cardio = new Doctor;
       
        $cardio->name = $request->input('name');
     
   $cardio->image = $request->file('file')->store('images');
        $cardio->department = $request->input('department');
        $cardio->degree = $request->input('degree');
        $cardio->visiting_place = $request->input('visiting_place');
        $cardio->city = $request->input('city');
        $cardio->day = $request->input('day');
        $cardio->time = $request->input('time');
      
        $cardio->fee = $request->input('fee');

        
       
        $cardio->save();
        return $cardio;

      

    }

    function loaddetails($id){

        $cardio = Doctor::find($id);
        return response()->json([

            'status' => "success",
            'cardio' => $cardio,
        ]);
    }

    function appointment(Request $request){

      

        $appointment = new Appointment;
       
        $appointment->doctors_name = $request->input('doctors_name');
        $appointment->name = $request->input('name');
        $appointment->visiting_place = $request->input('visiting_place');
        $appointment->fee = $request->input('fee');
        $appointment->day = $request->input('day');
        $appointment->time = $request->input('time');
        $appointment->payment_method = $request->input('payment_method');
        $appointment->appointment_key = $request->input('appointment_key');

   
     
       
        $appointment->save();
        return response()->json([
            'status'=> 'success',
            'message'=> 'Appointment has been confirmed successfully',



        ]);

        
    }

    function loadAppointment(){

        
       // return "hi";
        $appointment = Appointment::all();
       
        return response()->json([

            'status' => "success",
            'appointment' => $appointment
        ]);

    }

    public function destroy($id){

        $app = Appointment::find($id);

        $app->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Appointment has been canceled successfully',



        ]);


    }
    function loadAppointmentforRechedule($id){


        $app = Appointment::find($id);
        return response()->json([

            'status' => "success",
            'app' => $app,
        ]);


    }

    public function update(Request $request, $id){

     


       $appointment =  Appointment::find($id);

       $appointment->doctors_name = $request->input('doctors_name');
       $appointment->name = $request->input('name');
       $appointment->visiting_place = $request->input('visiting_place');
       $appointment->fee = $request->input('fee');
       $appointment->day = $request->input('day');
       $appointment->time = $request->input('time');
       $appointment->payment_method = $request->input('payment_method');
       $appointment->appointment_key = $request->input('appointment_key');
      
        $appointment->update();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Appointment has been rescheduled successfully',



        ]);
}


function loadDashboard(){

  
    $count = DB::table('appointments')->count();
    $doctorCount = DB::table('cardios')->count();
    $departmentCount = DB::table('departments')->count();


    //return $count;
    return response()->json([
        'status'=> 'success',
        'app'=> $count,
        "doctors" => $doctorCount,
        "departmentCount" => $departmentCount,



    ]);
}

function saveDepartment(Request $request){

    $dep = new Department;
   
    $dep->department = $request->input('department');
  
   
    $dep->save();
    return $dep;

 

}

function loadDepartment(){

 
     $dep = Department::all();
    
     return response()->json([

         'status' => "success",
         'dep' => $dep
     ]);
    //return $dep;

}
}
