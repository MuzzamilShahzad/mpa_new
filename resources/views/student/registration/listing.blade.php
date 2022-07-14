@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Registeration')

<style>
    .checkBox {
        width: 20px;
        height: 20px;
    }
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
                            <a href="{{ route('student.registration.create') }}" class="btn btn-primary" style="float:right">Add Registeration</a>
                            <div>
                                <h1 class="main-content-label mb-1">Search Registeration</h1>
                            </div>

                            <br>
                            <form action="" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control sessionSelect2" name="session_id" id="session-id">
                                                    <option value="">Select Session</option>
                                                    @foreach($data['sessions'] as $session)
                                                    <option value="{{$session->id}}">{{$session->session}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Campus</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="campus_id" id="campus-id">
                                                    <option value="">Select Campus</option>
                                                    @foreach($data['campuses'] as $campus)
                                                    <option value="{{$campus->id}}">{{$campus->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">System</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="system_id" id="system-id">
                                                    <option value="">Select System</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_id" id="class-id">
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_group_id" id="class-group-id">
                                                    <option value="">Select Class Group</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mt-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit" id="btn-registeration-search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr style="border: 1px solid black;">

                            <div class="d-flex">
                                <h1 class="main-content-label table-heading">{{ $data['menu'] }} </h1>
                            </div>

                            <br>

                            <div class="table-responsive" id="notifications">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th width="5px">
                                                <div class="form-check">
                                                    <input class="form-check-input checkBox" type="checkbox" value="" id="select-all">
                                                </div>
                                            </th>

                                            <th width="5px">S.NO</th>
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
                                                    <input class="form-check-input reg-checkbox" type="checkbox" value="{{ $student->registration_id }}" id="reg-{{ $student->registration_id }}">
                                                </div>
                                            </td>

                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <a data-bs-target="#student-details-modal" data-bs-toggle="modal" href="{{ $student->id }}" style="color: black" data-id="{{ $student->id }}" id="btn-student-details">{{$student->first_name}}</a>
                                            </td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ date('d/m/Y', strtotime($student->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('student.registration.forward', $student->registration_id) }}"> <button id="btn-forward" class="btn btn-success btn-sm action-btn"> <i class="fa fa-forward"></i> </button> </a>
                                                <button data-bs-target="#student-details-modal" data-bs-toggle="modal" href="{{ $student->id }}" data-id="{{ $student->id }}" id="btn-student-details" class="btn btn-info btn-sm action-btn"> Details </button>
                                                <button data-bs-target="#student-details-modal" data-bs-toggle="modal" href="{{ $student->id }}" data-id="{{ $student->id }}" id="btn-edit" class="btn btn-primary btn-sm action-btn"> Edit </button> </a>
                                                <button data-id="{{ $student->id }}" id="btn-delete-admission" class="btn btn-danger btn-sm action-btn"> Delete </button>
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

            <!-- Details Modal -->
            <div class="modal fade" id="student-details-modal" tabindex="-1" aria-labelledby="registrationDetails" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registrationDetails">Registration Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('student.registration.update') }}" method="POST" id="edit-detail-form">
                                <div class="row">

                                    <h4 class="main-content-label mb-3"> <strong>Student</strong></h4>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="session-id" class="form-label tx-semibold">Session</label>
                                            <select name="session_id" id="session-id" class="form-control sessionSelect2" disabled>
                                                <option selected value="">Select Session</option>
                                                @foreach($data['sessions'] as $session)
                                                <option value="{{$session->id}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                            <input type="hidden" name="id" id="record-id" class="form-control" />
                                            <select name="campus_id" id="campus-id" class="form-control campusSelect2" disabled>
                                                <option selected value="">Select Campus</option>
                                                @foreach($data['campuses'] as $campus)
                                                <option value="{{$campus->id}}">{{$campus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="school-id" class="form-label tx-semibold">School System</label>
                                            <select name="system_id" id="system-id" class="form-control systemSelect2" disabled>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-id" class="form-label tx-semibold">Class</label>
                                            <select name="class_id" id="class-id" class="form-control classSelect2" disabled>
                                                <option selected value="">Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-group-id" class="form-label tx-semibold">Class Group</label>
                                            <select name="class_group_id" id="class-group-id" class="form-control classGroupSelect2" disabled>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="registration-number" class="form-label tx-semibold">Registration Number</label>
                                            <input type="text" name="registration-number" id="registration-number" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="form-number" class="form-label tx-semibold">Form Number</label>
                                            <input type="text" name="form_no" id="form-number" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="first-name" class="form-label tx-semibold">First Name</label>
                                            <input type="text" name="first_name" id="first-name" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="last-name" class="form-label tx-semibold">Last Name</label>
                                            <input type="text" name="last_name" id="last-name" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="dob" class="form-label tx-semibold">Date of Birth</label>
                                            <input class="form-control date-picker bg-transparent" name="dob" id="dob" placeholder="DD-MM-YYYY" type="date" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Gender</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="gender" id="gender" disabled>
                                                    <option selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Any sibling currently studying in MPA ?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="siblings_in_mpa" id="siblings-in-mpa" disabled>
                                                    <option value="">Select If Any</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">No. of Siblings</label>
                                            <input type="text" class="form-control" name="no_of_siblings" id="no-of-siblings" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="previous_class_id" id="previous-class-id" disabled>
                                                    <option value="">Select</option>
                                                    @foreach($data['classes'] as $class)
                                                    <option value="{{$class->id}}">{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous School (IF ANY)</label>
                                            <input type="text" class="form-control" name="previous_school" id="previous-school" readonly>
                                        </div>
                                    </div>
                                </div>

                                <hr style="border: 1px solid lightgrey;">

                                <div class="row mt-3">

                                    <h4 class="main-content-label mb-3"> <strong>Current Address</strong></h4>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">House / Apartment Number</label>
                                            <input type="text" class="form-control" name="house_no" id="house-no" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="block_no" id="block-no" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="building_no" id="building-no" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="area_id" id="area-id" disabled>
                                                    <option selected value="">Select Area</option>
                                                    @foreach($data['areas'] as $area)
                                                    <option value="{{$area->id}}">{{$area->area}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">City</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="city_id" id="city-id" disabled>
                                                    <option selected value="">Select City</option>
                                                    @foreach($data['cities'] as $city)
                                                    <option value="{{$city->id}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr style="border: 1px solid lightgrey;">

                                <div class="row mt-3">
                                    <h4 class="main-content-label mb-3"> <strong>Father</strong> </h4>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father CNIC Number</label>
                                            <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" id="father-name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Occupation</label>
                                            <input type="text" class="form-control" name="father_occupation" id="father-occupation" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="father_company_name" id="father-company-name" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Salary</label>
                                            <input type="number" class="form-control" name="father_salary" id="father-salary" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Email</label>
                                            <input type="text" class="form-control" name="father_email" id="father-email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Phone No</label>
                                            <input type="text" class="form-control" name="father_phone" id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">How did you hear about us?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="hear_about_us" id="hear-about-us-update" disabled>
                                                    <option value="">Select</option>
                                                    <option value="social_media">Social Media</option>
                                                    <option value="electronic_media">Electronic Media</option>
                                                    <option value="print_media">Print Media</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Test Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="test_group_id" id="test-group-id" disabled>
                                                    <option value="">Select Test</option>
                                                    @foreach($data['tests'] as $test)
                                                    <option value="{{$test->id}}">{{$test->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Interview Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="interview_group_id" id="interview-group-id" disabled>
                                                    <option value="">Select Interview</option>
                                                    @foreach($data['interviews'] as $interview)
                                                    <option value="{{$interview->id}}">{{$interview->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                            <button type="button" class="btn btn-info" id="btn-edit-registration"> Edit Details </button>
                            <button type="button" class="btn btn-primary" id="btn-save-registration" disabled> Save Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promote Student Modal -->
            <div class="modal fade" id="promote-student-modal" tabindex="-1" aria-labelledby="promoteStudent" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="promoteStudent">Promotion Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('student.registration.promote') }}" method="POST" id="promotion-form">
                                <div class="row">

                                    <h4 class="main-content-label mb-3"> <strong>Student</strong></h4>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="session-id" class="form-label tx-semibold">Session</label>
                                            <select name="session_id" id="session-id-updated2" class="form-control sessionSelect2">
                                                <option selected value="">Select Session</option>
                                                @foreach($data['sessions'] as $session)
                                                <option value="{{$session->id}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                            <input type="hidden" name="id" id="record-id" class="form-control" />
                                            <select name="campus_id" id="campus-id" class="form-control select2">
                                                <option value="">Select Campus</option>
                                                @foreach($data['campuses'] as $campus)
                                                <option value="{{$campus->id}}">{{$campus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="school-id" class="form-label tx-semibold">School System</label>
                                            <select name="system_id" id="system-id" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-id" class="form-label tx-semibold">Class</label>
                                            <select name="class_id" id="class-id" class="form-control select2">
                                                <option value="">Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-group-id" class="form-label tx-semibold">Class Group</label>
                                            <select name="class_group" id="class-group-id" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                            <button type="button" class="btn btn-primary" id="btn-save-promotion"> Save Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('backend/assets/js/student/registration.js') }}"></script>

@endsection