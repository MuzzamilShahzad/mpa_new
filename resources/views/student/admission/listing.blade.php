@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Admission')

<style>
    .chkbox-select-all-admission {
        width: 20px; 
        height: 20px;
    }
    .fa-check{
        color: #19b159;
    }
    .fa-edit{
        color: #4d65d9;
    }
    .fa-trash{
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
                            <a href="{{ route('admission.create') }}" class="btn btn-primary" style="float:right">Add Admission</a>
                            <div>
                                <h1 class="main-content-label mb-1">Search Students</h1>
                            </div>
                            <br>
                            <form method="GET" action="{{ route('admission.listing') }}">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control sessionSelect2" name="session_id" id="session-id">
                                                    <option value="">Select Session</option>
                                                    @foreach($data['session'] as $session)
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
                                                <select class="form-control campusSelect2" name="campus_id" id="campus-id">
                                                    <option value="">Select Student</option>
                                                    @foreach($data['campus'] as $campus)
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
                                                <select class="form-control systemSelect2" name="system_id" id="system-id">
                                                    <option value="">Select System</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control classSelect2" name="class_id" id="class-id">
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control classGroupSelect2" name="group_id" id="group-id">
                                                    <option value="">Select Class Group</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Section</label>
                                            <div class="pos-relative">
                                                <select class="form-control sectionSelect2" name="section_id" id="section-id">
                                                    <option selected value="">Select Section</option>
                                                    @foreach($data['section'] as $section)
                                                        <option value="{{$section->id}}">{{$section->section}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mt-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit" id="btn-admission-search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                            <hr style="border: 1px solid black;">
                            <div class="d-flex">
                                <h1 class="main-content-label table-heading mb-1">{{ $data['menu'] }} </h1>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="admission-listing-datatable">
                                    <thead>
                                        <tr>
                                            <th> 
                                                <div class="form-check">
                                                    <input class="form-check-input chkbox-select-all-admission" type="checkbox">
                                                </div>
                                            </th>
                                            <th>Temp Gr / Gr No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Father Name</th>
                                            <th>Campus (System)</th>
                                            <th>Class (Group)</th>
                                            <!-- <th>Section</th> -->
                                            <th>Admission Date</th>
                                            <th>Action</th>
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

            <!-- Promote Student Modal -->
            <div class="modal fade" id="promote-student-modal" tabindex="-1" aria-labelledby="promoteStudent" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="promoteStudent">Promotion Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admission.promote') }}" method="POST" id="promotion-form">
                                <div class="row">

                                    <h4 class="main-content-label mb-3"> <strong>Student</strong></h4>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="session-id" class="form-label tx-semibold">Session</label>
                                            <select name="session_id" id="session-id" class="form-control sessionSelect2">
                                                <option selected value="">Select Session</option>
                                                @foreach($data['session'] as $session)
                                                <option value="{{$session->id}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                            <input type="hidden" name="id" id="record-id" class="form-control" />
                                            <select name="campus_id" id="campus-id" class="form-control campusSelect2">
                                                <option value="">Select Campus</option>
                                                @foreach($data['campus'] as $campus)
                                                <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="school-id" class="form-label tx-semibold">School System</label>
                                            <select name="system_id" id="system-id" class="form-control systemSelect2">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-id" class="form-label tx-semibold">Class</label>
                                            <select name="class_id" id="class-id" class="form-control classSelect2">
                                                <option value="">Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-group-id" class="form-label tx-semibold">Class Group</label>
                                            <select name="group_id" id="group-id" class="form-control classGroupSelect2">
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

<script src="{{ url('backend/assets/js/student/admission.js') }}"></script>

@endsection