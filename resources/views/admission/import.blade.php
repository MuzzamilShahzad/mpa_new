@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Admission')

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">

             <!-- Page Header -->
            <div class="page-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['menu'] }}</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            
            @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="card custom-card">
                <div class="card-header">
                    <div>
                        <h6 class="main-content-label">{{ $data['menu'] }}</h6>
                    </div>
                </div>
                <div class="card-body">             
                    <form action="{{ route('admission.import.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-0">
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
                            <div class="form-group col-md-4 mb-0">
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
                            <div class="form-group col-md-4 mb-0">
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
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 mb-0">
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
                            <div class="form-group col-md-4 mb-0">
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
                            <div class="form-group col-md-4 mb-0">
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
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-12 col-sm-12">
                                <input type="file" name="import_file" class="dropify" data-height="180">
                                <span style="color: red;"><b>@error ('import_file') {{$message}} @enderror</b></span>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Import</button>
                            <a href="{{ route('admission.create') }}" class="btn btn-danger" type="submit">Back</a>
                        </div>
                    </form>
                </div>
                <button type="submit" class="btn btn-primary" id="btn-import">Save</button>
            </form>    
        </div>
    </div>
</div>

@endsection