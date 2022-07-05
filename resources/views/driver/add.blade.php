@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Driver')

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
                                    <form action="{{ route('driver.store') }}" method="post">
                                        <div class="form-group">
                                            <label class="tx-semibold">Name</label>
                                            <input name="name" class="form-control" type="text" placeholder="Enter Name" id="name">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Address</label>
                                            <div class="pos-relative">
                                                <input name="address" class="form-control pd-r-80" type="text" placeholder="Enter Address" id="address">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">CNIC</label>
                                            <div class="pos-relative">
                                            <input name="cnic" class="form-control pd-r-80" type="text" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X" id="cnic">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">License Number</label>
                                            <div class="pos-relative">
                                                <input name="license_no" class="form-control pd-r-80" type="text" placeholder="Enter License Number" id="license-no">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Joining Date</label>
                                            <div class="pos-relative">
                                                <input class="form-control date-picker" name="joining_date" id="joining-date" placeholder="DD/MM/YYYY" type="text">
                                            </div>
                                        </div>

                                        <button type="submit" id="btn-add-driver" class="btn ripple btn-primary">Save</button>
                                        <a href="{{ route('driver.view') }}" class="btn ripple btn-danger">Back</a>
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
<script src="{{ url('assets/js/driver/driver.js') }}"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
    $(":input").inputmask();
</script>

@endsection
