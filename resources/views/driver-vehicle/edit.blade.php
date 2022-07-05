@extends('layouts.app')
@section('main-content')
@section('page_title', 'Update Driver Vehicle')

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
                <!-- <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                            <i class="fe fe-settings"></i>
                            <span>Settings</span>
                        </button>
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-download-cloud bg-white-transparent text-white"></i>
                            <span>Reports</span>
                        </button>
                    </div>
                </div> -->
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
                                    <form action="{{ route('driver-vehicle.update', $driverVehicle->id) }}" method="put">

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Vehicle</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="vehicle_id" id="vehicle_id">
                                                    @foreach($vehicle as $item)
                                                        <option value="{{$item->id}}" {{$item->id == $driverVehicle->vehicle_id ? 'selected' : null }}>{{$item->maker}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Route</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="route_id" id="route_id">
                                                    @foreach($route as $item)
                                                        <option value="{{$item->id}}" {{$item->id == $driverVehicle->route_id ? 'selected' : null }}>{{$item->area}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Driver</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="driver_id" id="driver_id">
                                                    @foreach($driver as $item)
                                                        <option value="{{$item->id}}" {{$item->id == $driverVehicle->driver_id ? 'selected' : null }}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="tx-semibold">Select Shift Time</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="shift_time_id" id="shift_time_id">
                                                    @foreach($shift as $item)
                                                        <option value="{{$item->id}}" {{$item->id == $driverVehicle->shift_time_id ? 'selected' : null }}>{{$item->timings}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                    
                                        <button type="submit" id="btn-update-driver_vehicle" class="btn ripple btn-primary">Update</button>
                                        <a href="{{ route('driver-vehicle.view') }}" class="btn btn-danger">Back</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/assets/js/driver_vehicle/update.js"></script>

@endsection
