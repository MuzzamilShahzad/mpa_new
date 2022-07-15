@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Registeration')

<style>
    .chkbox-select-all-registration {
        width: 20px;
        height: 20px;
    }

    .fa-check {
        color: #19b159;
    }

    .fa-edit {
        color: #4d65d9;
    }

    .fa-trash {
        color: #ff334d;
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
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control session-select2" name="session_id" id="session-id">
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
                                                <select class="form-control campus-select2" name="campus_id" id="campus-id">
                                                    <option value="">Select Campus</option>
                                                    @foreach($data['campuses'] as $campus)
                                                    <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">System</label>
                                            <div class="pos-relative">
                                                <select class="form-control system-select2" name="system_id" id="system-id">
                                                    <option value="">Select System</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control class-select2" name="class_id" id="class-id">
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control group-select2" name="group_id" id="group-id">
                                                    <option value="">Select Class Group</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mt-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button" id="btn-registration-search">
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
                            <!-- <div class="table-responsive" id="notifications">
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
                            </div> -->
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="registraion-listing-datatable">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">
                                                <div class="form-check">
                                                    <input class="form-check-input chkbox-select-all-registration" type="checkbox">
                                                </div>
                                            </th>
                                            <th>Registration No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Father Name</th>
                                            <th>Campus (System)</th>
                                            <th>Class (Group)</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- Details Modal New -->
            <div id="edit-registeration-view"> </div>

        </div>
    </div>
</div>

<script src="{{ url('backend/assets/js/student/registration.js') }}"></script>

@endsection