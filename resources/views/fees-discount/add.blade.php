@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Fees Discount')

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
                                    <form action="{{ route('contractor.store') }}" method="post">

                                        <div class="form-group">
                                            <label class="tx-semibold">Name</label>
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Discount Code</label>
                                            <input class="form-control" type="text" name="discount_code" id="discount-code" placeholder="Enter Discount Code">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Amount</label>
                                            <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Enter Description" rows="3"></textarea>
                                        </div>

                                        <button class="btn ripple btn-primary" id="btn-add-fees-discount" type="submit">Save</button>
                                        <a href="{{ route('contractor.view') }}" class="btn ripple btn-danger">Back</a>
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
<script src="{{ url('assets/js/fees/fees-discount.js') }}"></script>

@endsection
