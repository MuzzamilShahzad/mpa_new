@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Vehicle')

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
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div>
                                <h6 class="main-content-label">{{ $data['menu'] }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <form action="{{ route('vehicle.store') }}" method="post">
                                        <div class="form-group">
                                            <label class="tx-semibold">Select Contractor</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="contractor_id" id="contractor-id">
                                                    <option selected value="">Select Contractor</option>
                                                    @foreach($data['Contractor'] as $contractor)
                                                        <option value="{{$contractor->id}}">{{$contractor->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="tx-semibold">Vehicle Number</label>
                                            <input name="vehicle_number" class="form-control" type="text" placeholder="Enter Vehicle Number" id="vehicle-number">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Maker</label>
                                            <div class="pos-relative">
                                                <input name="maker" class="form-control pd-r-80" type="text" placeholder="Enter Maker" id="maker">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Chassis Number</label>
                                            <div class="pos-relative">
                                                <input name="chassis_number" class="form-control pd-r-80" type="text" placeholder="Enter Chassis Number" id="chassis-number">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Engine Number</label>
                                            <div class="pos-relative">
                                                <input name="engine_number" class="form-control pd-r-80" type="text" placeholder="Enter Engine Number" id="engine-number">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Capacity</label>
                                            <div class="pos-relative">
                                                <input name="capacity" class="form-control pd-r-80" type="text" placeholder="Enter Capacity" id="capacity">
                                            </div>
                                        </div>
                                        <button type="submit" id="btn-add-vehicle" class="btn ripple btn-primary">Save</button>
                                        <a href="{{ route('vehicle.view') }}" class="btn btn-danger">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('assets/js/vehicle/vehicle.js') }}"></script>


@endsection
