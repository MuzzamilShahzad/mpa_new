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
use App\Models\TestInterviewGroup;

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
            'campus_id'              =>  'required|numeric|gt:0',
            'system_id'              =>  'required|numeric|gt:0',
            'class_id'               =>  'required|numeric|gt:0',
            'session_id'             =>  'required|numeric|gt:0',
            'form_no'                =>  'required|max:20',
            'first_name'             =>  'required|max:30',
            'last_name'              =>  'required|max:30',
            'gender'                 =>  'required',
            'siblings_in_mpa'        =>  'required',
            'no_of_siblings'         =>  'numeric|gt:0',
            'previous_class'         =>  'required|numeric|gt:0',
            'previous_school'        =>  'required',
            'house_no'               =>  'required',
            'building_no'            =>  'required',
            'block_no'               =>  'required',
            'previous_school'        =>  'required',
            'previous_school'        =>  'required',
            'area_id'                =>  'required|numeric|gt:0',
            'city_id'                =>  'required|numeric|gt:0',
            'father_name'            =>  'required',
            'father_cnic'            =>  'required',
            'father_phone'           =>  'required',
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

            $registration->registration_id     =  $request->reg_no;
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

            if($request->test_group_chkbox) {
                if($request->test_group) {
                    $registration->test_group_id = $request->test_group;
                }else {
                    $testGroup = new TestInterviewGroup;
                    $testGroup->session_id = $request->session_id;
                    $testGroup->name = $request->test_name;
                    $testGroup->type = "test";
                    $testGroup->date = $request->test_date;
                    $testGroup->time = $request->test_time;
        
                    $testQuery = $testGroup->save();

                    $registration->test_group_id = $testQuery->id;
                }

            }

            $query = $registration->save();

            // if ($query) {

            //     $response = array(
            //         'status'   =>  true, 
            //         'message'  =>  "Student has been registered successfully with registeration id $registration->registration_id."
            //     );

            //     return response()->json($response);

            // } else {

            //     $response = array(
            //         'status'   =>  false, 
            //         'message'  =>  'Some thing went worng please try again letter'
            //     );

            //     return response()->json($response);
            // }
        }
    }

    public function getStudentFormNumberByCampusIdAndSystemIdAndSessionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'      =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            
            $registration = Registration::where("campus_id", $request->campus_id)->where("session_id", $request->session_id)->where("system_id", $request->system_id)->orderBy('id', 'DESC')->limit(1)->first();
            $session = explode("-", $registration->session->session);
            $campus_details = $registration->campusDetails;

            $reg_no = $registration->registration_id;
            // $student_form_number = $campus_details->short_name.substr($session[0], -2)."000".++$reg_no;
            $student_form_number = ++$reg_no;

            return response()->json(["status" => true, "formNumber" => $student_form_number]);
        }
    }
    
}
