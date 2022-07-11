<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\Session;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;
use App\Models\Admission;

class AdmissionController extends Controller
{
    public function listing() {
        $admissions  =  Admission::all();
        $campus      =  Campus::where('is_active',1)->where('is_delete',0)->get();
        $session     =  Session::get();
        $area        =  Area::get();
        $city        =  City::get();
        $class       =  Classes::get();

        $data = array(
            'admissions'      =>  $admissions,
            'campuses'        =>  $campuses,
            'sessions'        =>  $sessions,
            'studentClasses'  =>  $studentClasses,
            'sections'        =>  $sections,
            'categories'      =>  $categories,
            'schoolHouses'    =>  $schoolHouses,
            'areas'           =>  $areas,
            'page'            =>  'Admission',
            'menu'            =>  'Manage Admission'
        );

        dd($data);

        return view('student.admission.listing', compact('data'));
    }

    public function create() {
        $campus   =  Campus::where('is_active',1)->where('is_delete',0)->get();
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
            'page'     =>  'Admission',
            'menu'     =>  'Add Admission'
        );

        return view('student.admission.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'temporary_gr'              =>  'required|digits_between:1,11',
            'gr'                        =>  'required|digits_between:1,11',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'group_id'                  =>  'nullable|numeric|gt:0|digits_between:1,11',
            'section_id'                =>  'nullable|numeric|gt:0|digits_between:1,11',
            'bform_crms_no'             =>  'required|numeric|gt:0|digits:11',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            'dob'                       =>  'nullable|date_format:d-m-Y',
            'gender'                    =>  'required|in:male,female',
            'place_of_birth'            =>  'required|alpha|max:30',
            'nationality'               =>  'required|alpha|max:30',
            'mother_tongue'             =>  'required|alpha|max:30',
            'previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'nullable|max:30',
            'mobile_no'                 =>  'nullable|max:20',
            'email'                     =>  'nullable|email|max:30',
            'admission_date'            =>  'nullable|date_format:d-m-Y',
            'blood_group'               =>  'nullable|digits_between:2,3',
            'height'                    =>  'nullable|gt:0|between:0,7.12',
            'weight'                    =>  'nullable|gt:0|between:0,7.12',
            'as_on_date'                =>  'nullable|date_format:d-m-Y',
            'fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            'religion'                  =>  'required|max:20',
            'religion_type'             =>  'required|in:sunni,asna_ashri,other',
            'religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',
            'siblings_in_mpa'           =>  'nullable|in:yes,no',
            'no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,yes|gt:0|digits_between:1,11',
            'student_vaccinated'        =>  'nullable|in:yes,no',
            'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,3',
            'father_email'              =>  'nullable|email|max:30',
            'father_name'               =>  'required|max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            'father_occupation'         =>  'nullable|alpha|max:30',
            'father_company_name'       =>  'nullable|max:30',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);
            
        } else {
            $success = false;
            // DB::beginTransaction();
            try {
                
                $formData =  $request->all();
                // dd($formData);

                $student  = new Student();
               
                $student->temporary_gr         =  $request->temporary_gr;
                $student->gr                   =  $request->gr;
                $student->roll_no              =  $request->roll_no;
                $student->session_id           =  $request->session_id;
                $student->campus_id            =  $request->campus_id;
                $student->system_id            =  $request->system_id;
                $student->class_id             =  $request->class_id;
                $student->group_id             =  $request->class_group_id;
                $student->section_id           =  $request->section_id;
                $student->bform_crms_no        =  $request->bform_crms_no;
                $student->first_name           =  $request->first_name;
                $student->last_name            =  $request->last_name;
                $student->dob                  =  isset($request->dob) ? date('Y-m-d', strtotime($request->dob)) : NULL;

                $student->gender               =  $request->gender;
                $student->place_of_birth       =  $request->place_of_birth;
                $student->nationality          =  $request->nationality;
                $student->mother_tongue        =  $request->mother_tongue;
                $student->previous_class_id    =  $request->previous_class;
                $student->previous_school      =  $request->previous_school;

                $student->mobile_no            =  $request->mobile_no;
                $student->email                =  $request->email;
                $student->admission_date       =  date('Y-m-d', strtotime($request->admission_date));

                $student->blood_group          =  $request->blood_group;
                $student->height               =  $request->height;
                $student->weight               =  $request->weight;
                $student->as_on_date           =  date('Y-m-d', strtotime($request->as_on_date));
                $student->fee_discount         =  $request->fee_discount;
                
                $student->religion             =  $request->religion;
                $student->religion_type        =  $request->religion_type;

                if($student->religion_type == "other"){
                    $student->religion_type_other  =  $request->religion_type_other;
                }
                
                if($student->siblings_in_mpa == "yes"){
                    $student->no_of_siblings  =  $request->no_of_siblings;
                }

                $student->student_vaccinated   =  $request->student_vaccinated;

                $fatherDetails = array(
                    'cnic'          =>  $request->father_cnic,
                    'salary'        =>  $request->father_salary,
                    'email'         =>  $request->father_email,
                    'name'          =>  $request->father_name,
                    'phone'         =>  $request->father_phone,
                    'occupation'    =>  $request->father_occupation,
                    'company_name'  =>  $request->father_company_name,
                    'vaccinated'    =>  $request->father_vaccinated
                );
                $student->father_details = json_encode($fatherDetails);
                
                $motherDetails = array(
                    'cnic'          =>  $request->mother_cnic,
                    'salary'        =>  $request->mother_salary,
                    'email'         =>  $request->mother_email,
                    'name'          =>  $request->mother_name,
                    'phone'         =>  $request->mother_phone,
                    'occupation'    =>  $request->mother_occupation,
                    'company_name'  =>  $request->mother_company_name,
                    'vaccinated'    =>  $request->mother_vaccinated
                );
                $student->mother_details = json_encode($motherDetails);

                $guardianDetails = array(
                    'cnic'               =>  $request->guardian_cnic,
                    'name'               =>  $request->guardian_name,
                    'phone'              =>  $request->guardian_phone,
                    'relation'           =>  $request->guardian_relation,
                    'other_relation'     =>  $request->guardian_relation == 'other' ? $request->guardian_other_relation : NULL,
                    'first_person_call'  =>  $request->first_person_call,
                );
                
                $student->guardian_details = json_encode($guardianDetails);
               
                $currentAddress = array(
                    'current_house_no'            =>  $request->current_house_no,
                    'current_block_no'            =>  $request->current_block_no,
                    'current_building_name_no'    =>  $request->current_building_name_no,
                    'current_area_id'             =>  $request->current_area_id,
                    'current_city_id'             =>  $request->current_city_id
                );

                if($request->same_as_current == 'on'){
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'yes'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->current_house_no,
                        'permanent_block_no'            =>  $request->current_block_no,
                        'permanent_building_name_no'    =>  $request->current_building_name_no,
                        'permanent_area_id'             =>  $request->current_area_id,
                        'permanent_city_id'             =>  $request->current_city_id
                    );

                } else {
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'no'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->permanent_house_no,
                        'permanent_block_no'            =>  $request->permanent_block_no,
                        'permanent_building_name_no'    =>  $request->permanent_building_name_no,
                        'permanent_area_id'             =>  $request->permanent_area_id,
                        'permanent_city_id'             =>  $request->permanent_city_id
                    );

                }

                $student->address_details = json_encode(array(
                    'current_address'    =>  $currentAddress,
                    'same_as_current'    =>  $sameAsCurrent,
                    'permanent_address'  =>  $permanentAddress

                ));

                // dd($student);
                
                if($student->save()){
                    
                    dd("saved");
                } else {
                    
                    dd("Error Occured");
                }


                $student = Student::create([

                    'temporary_gr'        =>  $request->temporary_gr,
                    'gr'                  =>  $request->gr,
                    'bform_crms_no'       =>  $request->bform_crms_no,
                    'dob'                 =>  date('Y-m-d', strtotime($request->dob)),
                    'gender'              =>  $request->gender,
                    'place_of_birth'      =>  $request->place_of_birth,
                    'nationality'         =>  $request->nationality,
                    'mother_tongue'       =>  $request->mother_tongue,
                    'first_name'          =>  $request->first_name,
                    'last_name'           =>  $request->last_name,
                    'religion'            =>  $request->religion,
                    'admission_date'      =>  date('Y-m-d', strtotime($request->admission_date)),
                    'previous_class'      =>  $request->previous_class,
                    'previous_school'     =>  $request->previous_school,
                    'blood_group'         =>  $request->blood_group,
                    'height'              =>  $request->height,
                    'weight'              =>  $request->weight,
                    'student_vaccinated'  =>  $request->student_vaccinated,
                    'as_on_date'          =>  date('Y-m-d', strtotime($request->as_on_date)),
                    'fee_discount'        =>  $request->fee_discount,
                    'system'              =>  $request->system,
                    'roll_no'             =>  $request->roll_no,
                    'temporary_gr'        =>  $request->temporary_gr,
                    'mobile_no'           =>  $request->mobile_no,
                    'email'               =>  $request->email
                ]);

                if ($student) {

                    $studentFatherDetails = StudentFatherDetails::create([
                        'name'          =>  $request->father_name,
                        'cnic'          =>  $request->father_cnic,
                        'phone'         =>  $request->father_phone,
                        'email'         =>  $request->father_email,
                        'occupation'    =>  $request->father_occupation,
                        'company_name'  =>  $request->father_company_name,
                        'salary'        =>  $request->father_salary,
                        'vaccinated'    =>  $request->father_vaccinated
                    ]);

                    if ($studentFatherDetails) {

                        $studentMotherDetails = StudentMotherDetails::create([
                            'name'          =>  $request->mother_name,
                            'cnic'          =>  $request->mother_cnic,
                            'phone'         =>  $request->mother_phone,
                            'email'         =>  $request->mother_email,
                            'occupation'    =>  $request->mother_occupation,
                            'company_name'  =>  $request->mother_company_name,
                            'salary'        =>  $request->mother_salary,
                            'vaccinated'    =>  $request->mother_vaccinated
                        ]);

                        if ($studentMotherDetails) {

                            $studentGuardianDetails = StudentGuardianDetails::create([
                                'name'               =>  $request->guardian_first_name,
                                'phone'              =>  $request->guardian_phone,
                                'relation'           =>  $request->guardian_relation,
                                'other_relation'     =>  $request->other_relation,
                                'first_person_call'  =>  $request->first_person_call,
                                'cnic'               =>  $request->guardian_cnic
                            ]);

                            if ($studentGuardianDetails) {

                                if ($request->same_as_current == 'yes') {
                                    $permanent_house_no          =  $request->current_house_no;
                                    $permanent_block_no          =  $request->current_block_no;
                                    $permanent_building_name_no  =  $request->current_building_name_no;
                                    $permanent_city              =  $request->current_city;
                                    $permanent_area_id           =  $request->current_area_id; 
                                } else {
                                    $permanent_house_no          =  $request->permanent_house_no;
                                    $permanent_block_no          =  $request->permanent_block_no;
                                    $permanent_building_name_no  =  $request->permanent_building_name_no;
                                    $permanent_city              =  $request->permanent_city;
                                    $permanent_area_id           =  $request->permanent_area_id;
                                }

                                $studentAddressDetail = StudentAddressDetail::create([
                                    'current_house_no'            =>  $request->current_house_no,
                                    'current_block_no'            =>  $request->current_block_no,
                                    'current_building_name_no'    =>  $request->current_building_name_no,
                                    'current_city'                =>  $request->current_city,
                                    'current_area_id'             =>  $request->current_area_id,

                                    'permanent_house_no'          =>  $permanent_house_no,
                                    'permanent_block_no'          =>  $permanent_block_no,
                                    'permanent_building_name_no'  =>  $permanent_building_name_no,
                                    'permanent_city'              =>  $permanent_city,
                                    'permanent_area_id'           =>  $permanent_area_id
                                ]);

                                if ($studentAddressDetail) {

                                    $studentTransportDetails = StudentTransportDetails::create([
                                        'pick_and_drop'         =>  $request->pick_and_drop,
                                        'ride_vehicle_no'       =>  $request->ride_vehicle_no,

                                        'school_driver_name'    =>  $request->school_driver_name,
                                        'school_driver_phone'   =>  $request->school_driver_phone,
                                        'school_vehicle_no'     =>  $request->school_vehicle_no,

                                        'private_driver_name'   =>  $request->private_driver_name,
                                        'private_driver_phone'  =>  $request->private_driver_phone,
                                        'private_vehicle_no'    =>  $request->private_vehicle_no
                                    ]);

                                    if ($studentTransportDetails) {

                                        $studentReligionType = StudentReligionType::create([
                                            'religion_type'   =>  $request->religion_type,
                                            'other_religion'  =>  $request->other_religion
                                        ]);

                                        if ($studentReligionType) {

                                            $studentSiblingDetails = StudentSiblingDetails::create([
                                                'siblings_in_mpa'  =>  $request->siblings_in_mpa,
                                                'no_of_siblings'   =>  $request->no_of_siblings
                                            ]);

                                            if ($studentSiblingDetails) {

                                                $studentDetails = StudentDetails::create([
                                                    'student_id'                =>  $student->id,
                                                    'campus_id'                 =>  $request->campus_id,
                                                    'session_id'                =>  $request->session_id,
                                                    'class_id'                  =>  $request->class_id,
                                                    'section_id'                =>  $request->section_id,
                                                    'category_id'               =>  $request->category_id,
                                                    'school_house_id'           =>  $request->school_house_id,

                                                    'student_father_id'         =>  $studentFatherDetails->id,
                                                    'student_mother_id'         =>  $studentMotherDetails->id,
                                                    'student_guardian_id'       =>  $studentGuardianDetails->id,
                                                    'student_address_id'        =>  $studentAddressDetail->id,
                                                    'student_transport_id'      =>  $studentTransportDetails->id,
                                                    'student_religion_type_id'  =>  $studentReligionType->id,
                                                    'student_sibling_id'        =>  $studentSiblingDetails->id
                                                ]);

                                                if ($studentDetails) {

                                                    $success = true;

                                                    if ($success) {
                                                        DB::commit();

                                                        $response = array(
                                                            'status'   =>  true, 
                                                            'message'  =>  'Admission has been completed successfully.'
                                                        );
                                                        return response()->json($response);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                // DB::rollback();
                $success = false;
                $response = array(
                    'status'   =>  false, 
                    'message'  =>  $e
                );
                return response()->json($response);
            }
        }
    }
}
