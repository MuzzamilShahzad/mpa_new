<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\Session;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;
use App\Models\Registration;

class StudentRegistrationController extends Controller
{

    public function add(){
        
        $campus   =  Campus::get();
        $session  =  Session::get();
        $area     =  Area::get();
        $city     =  City::get();
        $class    =  Classes::get();

        $data = array(
            'campus'   =>  $campus,
            'session'  =>  $session,
            'class'    =>  $class,
            'area'     =>  $area,
            'city'     =>  $city,
            'page'     =>  'Student Registration',
            'menu'     =>  'Add Student Registration'
        );

        return view('student.registration.add', compact('data'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'class_group_id'            =>  'numeric|gt:0|digits_between:1,11',
            // 'form_no'                   =>  'required|max:10',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            // 'dob'                       =>  'nullable|date_format:d-m-Y',
            'gender'                    =>  'required|alpha',
            // 'siblings_in_mpa'           =>  'nullable|numeric|gt:0|digits_between:1,11',
            // 'no_of_siblings'            =>  'nullable|numeric|gt:0|digits_between:1,11',
            // 'previous_class'            =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'max:60',
            // CURRENT ADDRESS
            'house_no'                  =>  'required|alpha_num|max:60',
            'block_no'                  =>  'required|alpha_num|max:60',
            // 'building_name_no'          =>  'required|alpha_num|max:60',
            'area_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            // 'city_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            // FATHERS DETAIL
            // 'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'father_name'               =>  'required|max:30',
            // 'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            // 'father_email'              =>  'nullable|email|max:60',
            // 'father_occupation'         =>  'alpha|max:30',
            'father_company_name'       =>  'max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            // 'hear_about_us'             =>  'alpha|max:20',
            // 'other'                     =>  'alpha|max:20',
            // TEST-INTERVIEW GROUP
            // 'test_group'                =>  'required_if:test_chkbox,on|numeric|gt:0|digits_between:1,11',
            // 'interview_group'           =>  'required_if:interview_chkbox,on|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {


            $father_details = json_encode([
                "father_name"           => $request->father_name,
                "father_cnic"           => $request->father_cnic,
                "father_phone"          => $request->father_phone,
                "father_email"          => $request->father_email,
                "father_company_name"   => $request->father_company_name,
                "father_occupation"     => $request->father_occupation,
                "father_salary"         => $request->father_salary,
            ]);

            $registration = new Registration;

            $registration->registration_id     =  "2";
            $registration->campus_id           =  $request->campus_id;
            $registration->system_id           =  $request->system_id;
            $registration->class_id            =  $request->class_id;
            $registration->class_group_id      =  $request->class_group_id;
            $registration->session_id          =  $request->session_id;
            $registration->area_id             =  $request->area_id;
            $registration->city_id             =  $request->city_id;
            $registration->form_no             =  $request->form_no;
            $registration->first_name          =  $request->first_name;
            $registration->last_name           =  $request->last_name;
            $registration->dob                 =  date("Y-m-d", strtotime($request->dob));
            $registration->gender              =  $request->gender;
            $registration->siblings_in_mpa     =  $request->siblings_in_mpa;
            $registration->no_of_siblings      =  $request->no_of_siblings;
            $registration->previous_class_id   =  $request->previous_class;
            $registration->previous_school     =  $request->previous_school;
            $registration->house_no            =  $request->house_no;
            $registration->building_no         =  $request->building_no;
            $registration->block_no            =  $request->block_no;
            $registration->father_details      =  $father_details;
            $registration->test_group_id       =  $request->test_group;
            $registration->interview_group_id  =  $request->interview_group;
            $registration->hear_about_us       =  $request->hear_about_us;
            $registration->hear_about_us_other =  $request->hear_about_us_other;
             
             
            $query = $registration->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Student has been registered successfully.'
                );

                return response()->json($response);

            } else {

                $response = array(
                    'status'   =>  false, 
                    'message'  =>  'Some thing went worng please try again letter'
                );

                return response()->json($response);
            }
        }
    }

    public function getStudentFormNumberByCampusIdAndSystemIdAndSessionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'       =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            
            return response()->json("working fine");
        }
    }
    
}
