@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Admission')

<style>
     .checkBox {width: 20px; height: 20px;}
</style>

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">{{ $data['menu'] }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['menu'] }}</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <a href="{{ route('admission.create') }}" class="btn btn-primary" style="float:right">Add Admission</a>
                            <div>
                                <h1 class="main-content-label mb-1">Search Students</h1>
                            </div>

                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-3 mb-0">
                                    <div class="form-group">
                                        <label class="form-label tx-semibold">Campus</label>
                                        <div class="pos-relative">
                                            <select class="form-control select2" name="campus_id" id="campus-id">
                                                <option selected value="">Select Student</option>
                                                @foreach($data['campuses'] as $campus)
                                                    <option value="{{$campus->id}}">{{$campus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label tx-semibold">Session</label>
                                        <div class="pos-relative">
                                            <select class="form-control select2" name="session_id" id="session-id">
                                                <option selected value="">Select Session</option>
                                                @foreach($data['sessions'] as $session)
                                                    <option value="{{$session->id}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 mb-0">
                                    <div class="form-group">
                                        <label class="form-label tx-semibold">Class</label>
                                        <div class="pos-relative">
                                            <select class="form-control select2" name="class_id" id="class-id">
                                                <option selected value="">Select Class</option>
                                                @foreach($data['studentClasses'] as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label tx-semibold">Section</label>
                                        <div class="pos-relative">
                                            <select class="form-control select2" name="section_id" id="section-id">
                                                <option selected value="">Select Section</option>
                                                @foreach($data['sections'] as $section)
                                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mt-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" id="btn-search-student">Search</button>
                                    </div>
                                </div>
                            </div>
                           
                            <hr style="border: 1px solid black;">

                            <div>
                                <h1 class="main-content-label mb-1">{{ $data['menu'] }} </h1>
                            </div>

                            <br>

                            <div class="table-responsive" id="notifications">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th width="5px"> 
                                                <div class="form-check">
                                                    <input class="form-check-input checkBox" type="checkbox" value="" id="flexCheckDefault">
                                                </div>
                                            </th>

                                            <th width="5px">S.NO</th>
                                            <th>Gr.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Admission Date</th>
                                            <th width="20px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['students'] as $key => $student)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                </div>
                                            </td>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$student->gr}}</td>
                                            <td>
                                                <a data-bs-target="#student-details-modal" data-bs-toggle="modal" href="{{$student->id}}" style="color: black" data-id="{{$student->id}}" id="btn-student-details">{{$student->first_name}}</a>
                                            </td>
                                            <td>{{$student->last_name}}</td>
                                            <td>{{$student->gender}}</td>
                                            <td>{{ date('d/m/Y', strtotime($student->admission_date)) }}</td>
                                            <td>
                                                <a href="{{ route('contractor.edit',$student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <button data-id="{{$student->id}}" id="btn-delete-contractor" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- Student Details Modal -->
<div class="modal fade" id="student-details-modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#student-details" role="button">Student Details</a>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="collapse mg-t-5" id="student-details">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Temporary G.R</label>
                                <input type="text" class="form-control" name="temporary_gr" id="temporary-gr" value="{{ $student->temporary_gr }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">G.R</label>
                                <input type="text" class="form-control" name="gr" id="gr" value="{{ $student->gr }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Campus</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="campus_id" id="campus-id">
                                        <option selected value="">Select Student</option>
                                        @foreach($data['campuses'] as $campus)
                                            <option value="{{$campus->id}}">{{$campus->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Session</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="session_id" id="session-id">
                                        <option selected value="">Select Session</option>
                                        @foreach($data['sessions'] as $session)
                                            <option value="{{$session->id}}">{{$session->session}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group" id="campus-system-input">
                            <label class="form-label tx-semibold">System</label>
                                <input type="text" class="form-control" name="system" id="system" value="{{ $student->system }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Roll Number</label>
                                <input type="text" class="form-control" name="roll_no" id="roll-no" value="{{ $student->roll_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Class</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="class_id" id="class-id">
                                        <option selected value="">Select Class</option>
                                        @foreach($data['studentClasses'] as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Section</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="section_id" id="section-id">
                                        <option selected value="">Select Section</option>
                                        @foreach($data['sections'] as $section)
                                            <option value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">B-Form / CRMS No </label>
                                <input type="text" class="form-control" name="bform_crms_no" id="bform-crms-no" value="{{ $student->bform_crms_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first-name" value="{{ $student['first_name'] }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last-name" value="{{ $student['last_name'] }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold date-picker">Date of Birth</label>
                                <input class="form-control date-picker" name="dob" id="dob" placeholder="DD-MM-YYYY" type="text" value="{{ $student->dob }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Gender</label>
                                <input type="text" class="form-control" name="height"  id="height" value="{{ $student->gender }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Place of Birth</label>
                                <input type="text" class="form-control" name="place_of_birth"  id="place-of-birth" value="{{ $student->place_of_birth }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Nationality</label>
                                <input type="text" class="form-control" name="nationality"  id="nationality" value="{{ $student->nationality }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Tongue</label>
                                <input type="text" class="form-control" name="mother_tongue"  id="mother-tongue" value="{{ $student->mother_tongue }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous Class</label>
                                <input type="text" class="form-control" name="previous_class"  id="previous-class" value="{{ $student->previous_class }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous School</label>
                                <input type="text" class="form-control" name="previous_school"  id="previous-school" value="{{ $student->previous_school }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Category</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="category_id" id="category-id">
                                        <option selected value="">Select Category</option>
                                        @foreach($data['categories'] as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Religion</label>
                                <input type="text" class="form-control" name="religion" id="religion" value="{{ $student->religion }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_no" id="mobile-no" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######" value="{{ $student->mobile_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $student->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold date-picker">Admission Date</label>
                                <input class="form-control date-picker" name="admission_date" id="admission-date" placeholder="DD-MM-YYYY" type="text" value="{{ $student->admission_date }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Blood Group</label>
                                <input type="text" class="form-control" name="height"  id="height" value="{{ $student->blood_group }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">School House</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="school_house_id" id="school-house-id">
                                        <option selected value="">Select School House</option>
                                        @foreach($data['schoolHouses'] as $house)
                                            <option value="{{$house->id}}">{{$house->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Height</label>
                                <input type="text" class="form-control" name="height"  id="height" value="{{ $student->height }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Weight</label>
                                <input type="text" class="form-control" name="weight"  id="weight" value="{{ $student->weight }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold date-picker">As on Date</label>
                                <input class="form-control date-picker" name="as_on_date" id="as-on-date" placeholder="DD-MM-YYYY" type="text" value="{{ $student->as_on_date }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Fee Discount</label>
                                <input type="text" class="form-control" name="fee_discount"  id="fee-discount" value="{{ $student->fee_discount }}" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Religion Type</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="religion_type" id="religion-type">
                                        <option selected value="">Select Religion Type</option>
                                        <option value="Sunni">Sunni</option>
                                        <option value="Asna Ashri">Asna Ashri</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group" id="religion-type-other-input">
                                <label class="form-label tx-semibold">Other</label>
                                <input type="text" class="form-control" name="other_religion" id="other-religion" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Is there any sibling currently studying in MPA ?</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="siblings_in_mpa" id="siblings-in-mpa">
                                        <option selected value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">No. of Siblings</label>
                                <input type="number" class="form-control" name="no_of_siblings"  id="no-of-siblings">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Student Vaccinated</label>
                                <div class="btn-list radiobtns radio-btn">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-yes" value="Yes" checked>
                                        <label class="btn btn-outline-primary" for="student-vaccinated-yes">Yes</label>

                                        <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-no" value="No">
                                        <label class="btn btn-outline-primary" for="student-vaccinated-no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid black;">
                </div>
            </div>

            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#father-details" role="button">Father Details</a>
            </div>
            <div class="collapse mg-t-5" id="father-details">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father CNIC Number</label>
                                <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Salary</label>
                                <input type="number" class="form-control" name="father_salary" id="father-salary">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Email</label>
                                <input type="text" class="form-control" name="father_email" id="father-email">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Name</label>
                                <input type="text" class="form-control" name="father_name" id="father-name">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Phone No</label>
                                <input type="text" class="form-control" name="father_phone"  id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Occupation</label>
                                <input type="text" class="form-control" name="father_occupation"  id="father-occupation">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Company Name</label>
                                <input type="text" class="form-control" name="father_company_name" id="father-company-name">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Vaccinated</label>

                                <div class="btn-list radiobtns radio-btn">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-yes" value="Yes" checked>
                                        <label class="btn btn-outline-primary" for="father-vaccinated-yes">Yes</label>

                                        <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-no" value="No">
                                        <label class="btn btn-outline-primary" for="father-vaccinated-no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid black;">
                </div>
            </div>

            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#mother-details" role="button">Mother Details</a>
            </div>
            <div class="collapse mg-t-5" id="mother-details">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother CNIC Number</label>
                                <input type="text" class="form-control" name="mother_cnic" id="mother-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Salary</label>
                                <input type="number" class="form-control" name="mother_salary" id="mother-salary">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Email</label>
                                <input type="text" class="form-control" name="mother_email" id="mother-email">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother-name">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Phone No</label>
                                <input type="text" class="form-control" name="mother_phone"  id="mother-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Occupation</label>
                                <input type="text" class="form-control" name="mother_occupation"  id="mother-occupation">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Company Name</label>
                                <input type="text" class="form-control" name="mother_company_name" id="mother-company-name">
                            </div>
                        </div>

                        <div class="form-group col-md-3 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Mother Vaccinated</label>

                                <div class="btn-list radiobtns radio-btn">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-yes" value="Yes" checked>
                                        <label class="btn btn-outline-primary" for="mother-vaccinated-yes">Yes</label>

                                        <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-no" value="No">
                                        <label class="btn btn-outline-primary" for="mother-vaccinated-no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid black;">
                </div>
            </div>

            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#guardian-details" role="button">Guardian Details</a>
            </div>
            <div class="collapse mg-t-5" id="guardian-details">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Guardian CNIC</label>
                                <input type="text" class="form-control" name="guardian_cnic" id="guardian-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Guardian First Name</label>
                                <input type="text" class="form-control" name="guardian_first_name" id="guardian-first-name">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Guardian Phone</label>
                                <input type="text" class="form-control" name="guardian_phone" id="guardian-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Guardian Relation</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="guardian_relation" id="guardian-relation">
                                        <option selected value="">Select Religion Type</option>
                                        <option value="Uncle/Aunty">Uncle/Aunty</option>
                                        <option value="GrandFather/GrandMother">GrandFather/GrandMother</option>
                                        <option value="Neighbours">Neighbours</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group" id="guardian-relation-other-input">
                                <label class="form-label tx-semibold">Other</label>
                                <input type="text" class="form-control" name="other_relation" id="other-relation" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">First Person to call in case of Emergency</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="first_person_call" id="first-person-call">
                                        <option selected value="">Select Person To Call</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Guardian">Guardian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid black;">
                </div>
            </div>

            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#address-details" role="button">Address Details</a>
            </div>
            <div class="collapse mg-t-5" id="address-details">
                <div class="modal-body">
                    <h4>Current Address</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">House / Apartment Number</label>
                                <input type="text" class="form-control" name="current_house_no" id="current-house-no">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Block Number</label>
                                <input type="text" class="form-control" name="current_block_no" id="current-block-no">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                <input type="text" class="form-control" name="current_building_name_no"  id="current-building-name-no">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Area</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="current_area_id " id="current-area-id">
                                        <option selected value="">Select Area</option>
                                        @foreach($data['areas'] as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">City</label>
                                <input type="text" class="form-control" name="current_city" id="current-city">
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border: 1px solid black;">

                <div class="modal-body">
                    <h4>Permenant Address</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">House / Apartment Number</label>
                                <input type="text" class="form-control" name="permenant_house_no" id="permenant-house-no">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Block Number</label>
                                <input type="text" class="form-control" name="permenant_block_no" id="permenant-block-no">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                <input type="text" class="form-control" name="permenant_building_name_no"  id="permenant-building-name-no">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Area</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="permenant_area_id" id="permenant-area-id">
                                        <option selected value="">Select Area</option>
                                        @foreach($data['areas'] as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">City</label>
                                <input type="text" class="form-control" name="permenant_city" id="permenant-city">
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid black;">
                </div>
            </div>

            <div class="modal-header">
                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-bs-toggle="collapse" href="#transport-details" role="button">Pick Up / Drop Off Transport Details</a>
            </div>
            <div class="collapse mg-t-5" id="transport-details">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12 mb-0">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Pick up / Drop off Transport Details</label>
                                <div class="pos-relative">
                                    <select class="form-control select2" name="pick_and_drop_detail" id="pick-and-drop-detail">
                                        <option selected value="">Select Pick/Drop</option>
                                        <option value="ByWalk">By Walk</option>
                                        <option value="ByRide">By Ride</option>
                                        <option value="SchoolVan">School Van</option>
                                        <option value="PrivateVan">Private Van</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="pick-drop-append-input">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Student Details Modal -->

<script src="{{ url('assets/js/admission/admission.js') }}"></script>

@endsection