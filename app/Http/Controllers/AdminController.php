<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{

    public function index()
    {
        return view('System_Admin.home.home');
    }

    // Patients
    public function getPatients()
    {
        $result = Patient::all();
        return view('System_Admin.patient.patient', compact('result'));
    }

    public function storePatient(Request $request)
    {

        $user = Patient::where('username', $request->username)->OrWhere('email', $request->email)->get();

        if(count($user) > 0){
            return redirect()->back()->with('error', 'Ooops! , This Username or Email is Already Exists!');
        }

        $photo_address = "uploads/avarar.png";
        if($request->file('photo')){
            $file = $request->file('photo');
            $name = 'uploads/patients/'.time().$file->getClientOriginalName();
            $file->move('uploads/patients/', $name);
            $photo_address = $name;
        }

        $patient = new Patient();
        $patient->firstname = $request->firstname;
        $patient->lastname = $request->lastname;
        $patient->dob = $request->dob;
        $patient->phone = $request->phone;
        $patient->username = $request->username;
        $patient->email = $request->email;
        $patient->password = Hash::make($request->password);
        $patient->photo = $photo_address;
        $patient->created = Carbon::now();
        $patient->updated = Carbon::now();
        $patient->save();

        if($patient){
            return redirect()->back()->with('success', 'Patient Registered Successfully');
        }else{
            return redirect()->back()->with('error', 'Ooops! , Please Check Your Internet Connection! Try Again');
        }
    }
}
