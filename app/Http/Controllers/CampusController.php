<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\System;
use App\Models\CampusDetails;

class CampusController extends Controller
{
    public function listing(){
        $Campus = Campus::all();
        $data = array(
            'Driver'    =>  $Campus,
            'page'      =>  'Campus',
            'menu'      =>  'Manage Campus'
        );

        return view('campus.listing', compact('data'));
    }

    public function add(){

        $Systems = System::all();
        
        $data = array(
            'page'       =>  'Campus',
            'menu'       =>  'Add Campus',
            'systems'    =>  $Systems
        );

        return view('campus.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'              =>  'required',
            'email'             =>  'required',
            'phone'             =>  'required',
            'address'           =>  'required',
            'active_session'    =>  'required|numeric',
            'system'            =>  'required|numeric',
            'short_name'        =>  'required|max:10',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $campus = new Campus;

            $campus->name           =  $request->name;
            $campus->email          =  $request->email;
            $campus->phone          =  $request->phone;
            $campus->address        =  $request->address;
            $campus->active_session =  $request->active_session;

            if(isset($request->logo)) {
                $imageName = time().'.'.$request->logo->extension();  
                $request->logo->move(public_path('uploads/campus/'), $imageName);
                $campus->logo = "uploads/campus/".$imageName;
            }

            $query = $campus->save();

            if ($query) {
                
                $campusDetails = new CampusDetails;
                $campusDetails->campus_id = $campus->id;
                $campusDetails->short_name = $request->short_name;
                $campusDetails->system_id = $request->system;
                
                $query2 = $campusDetails->save();

                if($query2) {

                    $response = array(
                        'status'   =>  true, 
                        'message'  =>  'Campus has been added successfully'
                    );
    
                    return response()->json($response);

                }else {

                    $response = array(
                        'status'   =>  false, 
                        'message'  =>  'Some thing went worng, please update campus details manually.'
                    );
    
                    return response()->json($response);

                }


            } else {

                $response = array(
                    'status'   =>  false, 
                    'message'  =>  'Some thing went worng please try again letter'
                );

                return response()->json($response);
            }
        }
    }

    public function edit($id){
        $system = System::find($id);
        $data = array(
            'driver'  =>  $system,
            'page'    =>  'System',
            'menu'    =>  'Edit System'
        );

        return view('system.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'address'       =>  'required',
            'cnic'          =>  'required',
            'license_no'    =>  'required',
            'joining_date'  =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $system = System::find($id);

            $driver->name          =  $request->name;
            $driver->address       =  $request->address;
            $driver->cnic          =  $request->cnic;
            $driver->license_no    =  $request->license_no;
            $driver->joining_date  =  date('Y-m-d', strtotime($request->joining_date));

            $query = $driver->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Driver has been updated successfully'
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

    public function delete(Request $request) {
        $system_id  =  $request->system_id;
        $query      =  System::find($system_id)->delete();

        if ($query) {

            $response = array(
                'status'   =>  true, 
                'message'  =>  'Record has been deleted successfully!'
            );
        }

        else {
            $response = array(
                'status'   =>  false,
                'message'  =>  'Some thing went worng try again later!'
            );
        }

        return response()->json($response); 
    }
}
