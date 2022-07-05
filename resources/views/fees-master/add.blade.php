@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Fees Master')

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
                                            <label class="tx-semibold">Select Fees Month</label>
                                            <select class="form-control select2" name="fees_month" id="fees-month">
                                                <option selected value="">Select Fees Month</option>
                                                    <option value="A">A</option>
                                                    <option value="">B</option>
                                                    <option value="">C</option>
                                                    <option value="">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Campus</label>
                                            <select class="form-control select2" name="campus_id" id="campus-id">
                                                <option selected value="">Select Campus</option>
                                                    <option value="A">A</option>
                                                    <option value="">B</option>
                                                    <option value="">C</option>
                                                    <option value="">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Fees Type</label>
                                            <select class="form-control select2" name="fees_type_id" id="fees-type-id">
                                                <option selected value="">Select Fees Type</option>
                                                    <option value="A">A</option>
                                                    <option value="">B</option>
                                                    <option value="">C</option>
                                                    <option value="">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Session</label>
                                            <select class="form-control select2" name="session_id" id="session-id">
                                                <option selected value="">Select Session</option>
                                                    <option value="A">A</option>
                                                    <option value="">B</option>
                                                    <option value="">C</option>
                                                    <option value="">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Select Class</label>
                                            <select class="form-control select2" name="class_id" id="class-id">
                                                <option selected value="">Select Class</option>
                                                    <option value="A">A</option>
                                                    <option value="">B</option>
                                                    <option value="">C</option>
                                                    <option value="">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Category</label>
                                            <input class="form-control" type="text" name="category" id="category" placeholder="Enter Category">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Due Date</label>
                                            <input class="form-control date-picker" name="due_date" id="due-date" placeholder="DD-MM-YYYY" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Amount</label>
                                            <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount">
                                        </div>

                                        <button class="btn ripple btn-primary" id="btn-add-fees-master" type="submit">Save</button>
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
<script src="{{ url('assets/js/fees/fees-master.js') }}"></script>

@endsection
