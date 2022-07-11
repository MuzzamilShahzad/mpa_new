<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function listingByType(Request $request) {

        $vehicle_type = 'school_van,by_private_van';

        // dd(str_replace('by_',"",$request->vehicle_type));

        $validator   = Validator::make($request->all(),[
            'vehicle_type'  =>  'required|in:'.$vehicle_type,
        ]);

       
        if($validator->errors()){
            
            $vehice_type  =  str_replace('by_',"",$request->vehicle_type); 
            $vehicles  =  Vehicle::where('vehicle_type',$vehice_type)->where('is_active',1)->where('is_delete',0)->get();
            $response = array(
                'status'    => TRUE,
                'vehicles'  =>  $vehicles
            );

        } else {
            
            $response = array(
                'status'    => FALSE,
                'error'  =>  $validator->errors()
            );
        }

        return response()->json($response);
    }
}
