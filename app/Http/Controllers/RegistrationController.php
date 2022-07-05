<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\Session;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;

class RegistrationController extends Controller
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

}
