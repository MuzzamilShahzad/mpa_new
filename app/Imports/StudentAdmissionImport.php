<?php

namespace App\Imports;

use App\Models\Admission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Models\Classes;
use App\Models\Section;
use App\Models\System;
use App\Models\Campus;
use App\Models\Area;

class StudentAdmissionImport implements ToCollection, WithValidation, WithHeadingRow, SkipsOnFailure, ShouldAutoSize
{

    use Importable, SkipsFailures;

    public $campus_id;
    public $class_id;
    public $section_id;
    public $session_id;
    public $system_id;
    public $group_id;
    public $my_error_bag = [];

    public function  __construct($data)
    {

        $this->campus_id        = $data["campus_id"];
        $this->class_id         = $data["class_id"];
        $this->section_id       = $data["section_id"];
        $this->session_id       = $data["session_id"];
        $this->system_id        = $data["system_id"];
        $this->group_id         = $data["group_id"];

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        // dd($rows);
        foreach($rows as $row) {
                        
            $admisssion                         = new Admission();

            $admisssion                         = new Admission();
            $admisssion->campus_id              = (isset($this->campus_id)  && !empty($this->campus_id)     ? $this->campus_id      : $row["campus_id"]);
            $admisssion->class_id               = (isset($this->class_id)   && !empty($this->class_id)      ? $this->class_id       : $row["class_id"]);
            $admisssion->section_id             = (isset($this->section_id) && !empty($this->section_id)    ? $this->section_id     : $row["section_id"]);
            $admisssion->session_id             = isset($this->session_id) ? $this->session_id : '' ;
            $admisssion->group_id               = isset($this->group_id) ? $this->group_id : '';
            $admisssion->system_id              = (isset($this->system_id)  && !empty($this->system_id)     ? $this->system_id      : $row["system_id"]);
            $admisssion->temporary_gr           = $row["temporary_gr"];

            // dd($admisssion->temporary_gr);
            $admisssion->gr                     = $row["temporary_gr"];
            $admisssion->bform_crms_no          = $row["bform_crms_no"];
            $admisssion->first_name             = $row["first_name"];
            $admisssion->last_name              = $row["last_name"];
            $admisssion->dob                    = $row["dob"];
            $admisssion->gender                 = $row["gender"];
            $admisssion->place_of_birth         = "Karachi";
            $admisssion->nationality            = $row["nationality"];
            $admisssion->mother_tongue          = $row["mother_tongue"];
            // $admisssion->previous_class_id      = $row["previous_class_id"];
            $admisssion->previous_school        = $row["previous_school"];
            // $admisssion->mobile_no              = $row["mobile_no"];
            // $admisssion->email                  = $row["email"];
            $admisssion->admission_date         = $row["admission_date"];
            $admisssion->blood_group            = $row["blood_group"];
            $admisssion->height                 = $row["height"];
            $admisssion->weight                 = $row["weight"];
            // $admisssion->as_on_date             = $row["as_on_date"];
            // $admisssion->fees_discount          = $row["fees_discount"];
            $admisssion->religion               = "Islam";
            $admisssion->religion_type          = (isset($row["religion_type"]) && !empty($row["religion_type"]) && $row["religion_type"] == 'yes' ? 'asna_ashri' : "other");
            $admisssion->religion_type_other    = (isset($row["religion_type_other"]) && !empty($row["religion_type_other"] && $row["religion_type_other"] == "yes") ? $row["religion_type_other"] : "N/A");
            $admisssion->total_no_of_siblings   = $row["total_no_of_siblings"];
            $admisssion->siblings_in_mpa        = (isset($row["siblings_in_mpa"]) && !empty($row["siblings_in_mpa"]) && ($row["siblings_in_mpa"] > 0) ? "yes" : "no");
            $admisssion->no_of_siblings_in_mpa  = $row["siblings_in_mpa"];
            $admisssion->student_vaccinated     = "yes";
            $admisssion->pick_and_drop          = $row["pick_and_drop"];

            $admisssion->father_details         = json_encode([
                                                    "name"              => $row["father_name"],
                                                    "email"             => $row["father_email"],
                                                    "phone"             => $row["father_phone"],
                                                    "company_name"      => $row["father_company_name"],
                                                    "cnic"              => $row["father_cnic"],
                                                    "phone"             => $row["father_phone"],
                                                    "occupation"        => $row["father_occupation"],
                                                    "salary"            => $row["father_salary"],
                                                    "vaccinated"        => "yes"
                                                ]);

            $admisssion->mother_details         = json_encode([
                                                    "name"              => $row["mother_name"],
                                                    "email"             => $row["mother_email"],
                                                    "phone"             => $row["mother_phone"],
                                                    "company_name"      => $row["mother_company_name"],
                                                    "cnic"              => $row["mother_cnic"],
                                                    "phone"             => $row["mother_phone"],
                                                    "occupation"        => $row["mother_occupation"],
                                                    "salary"            => $row["mother_salary"],
                                                    "vaccinated"        => "yes"
                                                ]);

            $admisssion->guardian_details       = json_encode([
                                                    'cnic'               => $row["father_cnic"],
                                                    'name'               => $row["guardian_name"],
                                                    'phone'              => $row["guardian_phone"],
                                                    'relation'           => $row["guardian_relation"],
                                                    'other_relation'     => $row["guardian_relation"] == 'other' ? $row["guardian_relation_other"] : NULL,
                                                    'first_person_call'  => $row["first_person_call"],
                                                ]);


            $currentAddress                     = [
                                                    'current_house_no'            => $row["current_house_no"],
                                                    'current_block_no'            => $row["current_block_no"],
                                                    'current_building_name_no'    => isset($row["current_building_name_no"]) ? $row["current_building_name_no"] : 'N/A',
                                                    'current_area_id'             => $row["current_area"],
                                                    'current_city_id'             =>  "1"
                                                ];

            $permanentAddress                   = [
                                                    'permanent_house_no'            => $row["current_house_no"],
                                                    'permanent_block_no'            => $row["current_block_no"],
                                                    'permanent_building_name_no'    => isset($row["permanent_building_name_no"]) ? $row["permanent_building_name_no"] : 'N/A',
                                                    'permanent_area_id'             => $row["current_area"],
                                                    'permanent_city_id'             => "1"
                                                ];

            $admisssion->address_details       = json_encode([
                                                    'current_address'    =>  $currentAddress,
                                                    'same_as_current'    =>  ['same_as_current'  =>  "yes"],
                                                    'permanent_address'  =>  $permanentAddress
                                                ]);

            $admisssion->save();

        }
        
    }

    public function prepareForValidation($data, $index)
    {

        // dd(explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["father_phone"]))))[0]);
        // dd(explode('-', trim(preg_replace('/\s+/', '-', $data["mother_phone"]))));

        if(isset($data["class"]) && !empty($data["class"])) {
            $result                             = Classes::where('class', $data["class"])->first();
            $data["class_id"]                   = $result ? $result->id : "";
        }

        if(isset($data["section"]) && !empty($data["section"])) {
            $result                             = Section::where('section', $data["section"])->first();
            $data["section_id"]                 = ($result) ? $result->id : "";
        }

        if(isset($data["system"]) && !empty($data["system"])) {
            $result                             = System::where('system', $data["system"])->first();
            $data["system_id"]                  = ($result) ? $result->id : "";
        }

        if(isset($data["admission_class"]) && !empty($data["admission_class"])) {
            $result                             = Classes::where('class', $data["admission_class"])->first();
            $data["previous_class_id"]          = ($result) ? $result->id : "";
        }

        if(isset($data["campus"]) && !empty($data["campus"])) {
            $campus_name                        = "Campus ".$this->numberToRomanRepresentation((int) filter_var($data["campus"], FILTER_SANITIZE_NUMBER_INT));
            $result                             = Campus::where('campus', $campus_name)->first();
            $data["campus_id"]                  = ($result) ? $result->id : "";
        }

        $data['dob']                            = isset($data['dob'])                  ? date("Y-m-d", strtotime($data['dob']))            : '' ;
        $data['admission_date']                 = isset($data['admission_year'])       ? $data['admission_year']."-08-01"                  : '' ;
        $data['current_city_id']                = 1;
        $data['temporary_gr']                   = isset($data['temporary_gr'])         ? (string) $data['temporary_gr']                    : '' ;
        $data['gender']                         = isset($data['gender'])               ? strtolower($data['gender'])                       : '' ;
        $data['student_vaccinated']             = isset($data['student_vaccinated'])   ? strtolower($data['student_vaccinated'])           : '' ;
        $data['first_person_call']              = isset($data['first_person_call'])    ? strtolower($data['first_person_call'])            : '' ;
        
        $data['mother_vaccinated']              = isset($data['mother_vaccinated'])    ? strtolower($data['mother_vaccinated'])            : '' ;
        $data['mother_cnic']                    = isset($data['mother_cnic'])          ? str_replace('-', '', $data['mother_cnic'])        : '' ;       
        $data['mother_phone']                   = isset($data["mother_phone"])  ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["mother_phone"]))))[0] : '';
        $data['mother_phone']                   = isset($data["guardian_phone"])  ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["guardian_phone"]))))[0] : '';
        $data['mother_salary']                  = isset($data['mother_salary'])        ? str_replace('k', '000', strtolower($data["mother_salary"]))   : '' ;
        
        $data['father_cnic']                    = isset($data['father_cnic'])          ? str_replace('-', '', $data['father_cnic'])        : '' ;       
        $data['father_vaccinated']              = isset($data['father_vaccinated'])    ? strtolower($data['father_vaccinated'])            : '' ;
        $data['father_phone']                   = isset($data['father_phone'])         ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["father_phone"]))))[0]       : '' ;       
        $data['father_salary']                  = isset($data['father_salary'])       ? str_replace('k', '000', strtolower($data["father_salary"]))   : '' ;

        $data['pick_and_drop']                  = isset($data['pick_and_drop'])        ? str_replace(' ', '_', $data["pick_and_drop"])     : '' ;
        $data['pick_and_drop']                  = isset($data['pick_and_drop'])        ? strtolower($data['pick_and_drop'])                : '' ;

        $data['religion_type']   = strtolower(['sunni'] == 'yes') ? 'sunni' : (strtolower(['asna_ashri'] == 'yes') ? 'asna_ashri' : 'other');
        $data['religion_type_other']   = strtolower(['sunni'] == 'yes') ? '' : (strtolower(['asna_ashri'] == 'yes') ? '' : $data['religion_type']);
        
        if(isset($data['guardian_relation']) && !empty($data['guardian_relation'])) {
            $guardian_relations                 = ["uncle", "grand_father", "neighbours"];
            $guardian_relation                  = explode("/", $data['guardian_relation']);
            $data['guardian_relation']          = str_replace('d f', 'd_f', strtolower($guardian_relation[0]));
            $data['guardian_relation']          = str_replace(' ', '', $data['guardian_relation']);
            $data['guardian_relation']          = strtolower($data['guardian_relation']);

            if($data['guardian_relation'] == "grand_father") {
                $data['guardian_relation']      = "grandfather_grandmother";
            }else if($data['guardian_relation'] == "uncle") { 
                $data['guardian_relation']      = "uncle_aunty";
            }else if($data['guardian_relation'] == "neighbours") {
                $data['guardian_relation']      = "neighbours";
            }else {
                $data['guardian_relation']      = "other";
                $data['guardian_relation_other']      = $data['guardian_relation'];
            }
        }
        
        if(isset($data["current_area"]) && !empty($data["current_area"])) {
            $result                             = Area::where('area', 'like', '%'.$data["current_area"].'%')->first();
            if($result) {
                $data["current_area"]                   = $result->id;
            }else {
                $data["current_area"]                   = "";
            }

            // $data["current_area_id"]                   = 1;
        }
        return $data;

    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            
            // '*.temporary_gr'              =>  'required|unique:admissions,temporary_gr|string|min:1,max:20',  
            '*.temporary_gr'              =>  'required|string|max:20',  
            '*.campus'                    =>  'required|string|min:8,max:30',  
            '*.system'                    =>  'required|string|min:6,max:30',  
            '*.class'                     =>  'required|string|min:4,max:30',  
            '*.section'                   =>  'required|string|min:1,max:30',  
            '*.bform_crms_no'             =>  'nullable|min:5,max:20',
            '*.dob'                       =>  'nullable|date',
            '*.gender'                    =>  'required|in:male,female',
            '*.place_of_birth'            =>  'nullable|alpha|max:30',                                      // required => karachi
            '*.nationality'               =>  'required|alpha|max:30',
            '*.mother_tongue'             =>  'required|alpha|max:30',
            '*.first_name'                =>  'required|string|max:30',
            '*.last_name'                 =>  'nullable|string|max:30',
            '*.religion'                  =>  'required|in:islam,Islam',                         // issue if asna ok else other
            '*.religion_type'             =>  'nullable|in:sunni,asna_ashri,other',                         // issue if asna ok else other
            '*.religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',            // invalid => n/a
            // '*.admission_year'            =>  'required|max:'.(date('Y')+1),                                              // invalid => 1 aug
            '*.admission_year'            =>  'required|numeric|digits:4',                                             // invalid => 1 aug
            '*.admission_class'           =>  'nullable|string|max:20',
            '*.previous_school'           =>  'nullable|max:30',
            '*.blood_group'               =>  'nullable|min:2|max:3',
            '*.height'                    =>  'nullable|gt:0|between:1,10',
            '*.weight'                    =>  'nullable|gt:0|between:1,150',
            '*.student_vaccinated'        =>  'nullable|in:yes,no',
            // '*.mobile_no'                 =>  'nullable|max:20',
            // '*.email'                     =>  'nullable|email|max:30',
            // '*.as_on_date'                =>  'nullable|date',
            // '*.fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            '*.father_name'               =>  'required|max:30',
            // '*.father_cnic'               =>  'required|numeric|gt:0|digits:13',
            '*.father_cnic'               =>  'required|string|max:20',
            '*.father_phone'              =>  'nullable|string|min:11|max:20',                
            '*.father_email'              =>  'nullable|email|max:30',
            '*.father_occupation'         =>  'nullable|string|max:30',
            '*.father_company_name'       =>  'nullable|string|max:40',                                            // 30 -> 40                    
            '*.father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,10',
            '*.father_vaccinated'         =>  'nullable|in:yes,no',
            '*.mother_name'               =>  'required|max:30',
            '*.mother_cnic'               =>  'required|string|max:20',
            '*.mother_phone'              =>  'nullable|string|min:11|max:20',                    
            '*.mother_email'              =>  'nullable|email|max:30',
            '*.mother_occupation'         =>  'nullable|string:30',
            '*.mother_company_name'       =>  'nullable|max:40',
            '*.mother_salary'             =>  'nullable|numeric|gt:0|digits_between:1,10',
            '*.mother_vaccinated'         =>  'nullable|in:yes,no',
            '*.current_house_no'          =>  'required|max:30',
            '*.current_block_no'          =>  'required|max:30',
            '*.current_area'              =>  'required|string|max:30',
            // '*.guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
            '*.guardian_name'             =>  'nullable|max:30',
            '*.guardian_phone'            =>  'nullable|string|min:11|max:20',
            '*.guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',       // invalid
            // '*.guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
            '*.first_person_call'         =>  'required|in:father,mother,guardian',
            '*.pick_and_drop'             =>  'required|in:by_walk,by_ride,by_private_van,by_school_van',
            '*.total_no_of_siblings'      =>  'nullable|numeric|gt:0|digits_between:1,10', 
            '*.siblings_in_mpa'           =>  'nullable|numeric|gt:0|digits_between:1,10',
            // '*.no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,gt:0|gt:0|digits_between:1,10',  // issue
            // '*.vehicle_number'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
            // '*.vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,10',
            
        ];
    }
}
