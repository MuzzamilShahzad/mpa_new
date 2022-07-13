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
                                                <a href="{{ route('student.details',$student->id) }}" class="btn btn-info btn-sm">Details</a>
                                                <a href="{{ route('admission.edit',$student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <button data-id="{{$student->id}}" id="btn-delete-admission" class="btn btn-danger btn-sm">Delete</button>
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

<script src="{{ url('backend/assets/js/admission/admission.js') }}"></script>

@endsection