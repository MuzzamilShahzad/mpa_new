@extends('layouts.app')
@section('main-content')
@section('page_title', 'Student Details')

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

            <!--Row-->
            <div class="row">
                <div class="col-md-4">
                    <div class="card custom-card card-body bg-primary tx-white">
                        <div class="container" align="center">
                            <a href="profile.html"><img alt="avatar" class="rounded-circle" src="{{ url('assets/img/users/2.jpg')}}"></a>
                            <h3><p class="card-text">Student Name</p></h3>
                        </div>
                        
                        <hr>
                        <p class="mb-0"><strong>Admission No:</strong> 14362 </p>

                        <hr>
                        <p class="mb-0"><strong>Roll Number:</strong> B-878 </p>

                        <hr>
                        <p class="mb-0"><strong>Class:</strong> Class VIII (2021-22) </p>

                        <hr>
                        <p class="mb-0"><strong>Section:</strong> A </p>

                        <hr>
                        <p class="mb-0"><strong>RTE:</strong> ASD-6148 </p>
                        
                        <hr>
                        <p class="mb-0"><strong>Gender:</strong> Female </p>
                        <hr>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card custom-card">
                        <div class="card-header d-flex">
                            <h6 class="main-content-label">{{ $data['page'] }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="card-pay">
                                <ul class="tabs-menu nav mb-0">
                                    <li class=""><a href="#Profile" class="active" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Profile</a></li>
                                    <li><a href="#Fees" data-bs-toggle="tab" class=""><i class="fab fa-paypal"></i>  Fees</a></li>
                                    <li><a href="#Documents" data-bs-toggle="tab" class=""><i class="fa fa-university"></i>  Documents</a></li>
                                    <li><a href="#TimeLine" data-bs-toggle="tab" class=""><i class="fa fa-university"></i>  TimeLine</a></li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active show br-3 mb-2" id="Profile">
                                        <div class="form-group mt-4">
                                            <label class="form-label tx-semibold">CardHolder Name</label>
                                            <input type="text" class="form-control" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Card number</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search for...">
                                                <span class="input-group-btn btn btn-secondary box-shadow-0">
                                                    <i class="fab fa-cc-visa"></i> &nbsp;
                                                    <i class="fab fa-cc-amex"></i> &nbsp;
                                                    <i class="fab fa-cc-mastercard"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="form-label tx-semibold">Expiration</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control border-end-0" placeholder="MM" name="Month">
                                                        <input type="number" class="form-control" placeholder="YY" name="Year">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="form-label">CVV <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="CVV is the last 3 digits on the back of your Credit Card."></i></label>
                                                    <input type="number" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;" class="btn btn-primary">Confirm</a>
                                    </div>

                                    <div class="tab-pane" id="Fees">
                                        <p class="mt-4">Paypal is easiest way to pay online</p>
                                        <p><a href="javascript:;" class="btn btn-primary rounded-6"><i class="fab fa-paypal"></i> Log in my Paypal</a></p>
                                        <p class="mb-0"><strong>Note:</strong> Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                                    </div>

                                    <div class="tab-pane" id="Documents">
                                        <p class="mt-4">Bank account details</p>
                                        <dl class="card-text">
                                            <dt>BANK: </dt>
                                            <dd> THE UNION BANK 0456</dd>
                                        </dl>
                                        <dl class="card-text">
                                            <dt>Account number: </dt>
                                            <dd> 67542897653214</dd>
                                        </dl>
                                        <dl class="card-text">
                                            <dt>IBAN: </dt>
                                            <dd>543218769</dd>
                                        </dl>
                                        <p class="mb-0"><strong>Note:</strong> Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                                    </div>

                                    <div class="tab-pane" id="TimeLine">
                                        <p class="mt-4">Timeline</p>
                                        <dl class="card-text">
                                            <dt>ABCD: </dt>
                                            <dd> THE UNION BANK 0456</dd>
                                        </dl>
                                        <dl class="card-text">
                                            <dt>Account number: </dt>
                                            <dd> 67542897653214</dd>
                                        </dl>
                                        <dl class="card-text">
                                            <dt>IBAN: </dt>
                                            <dd>543218769</dd>
                                        </dl>
                                        <p class="mb-0"><strong>Note:</strong> Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                                    </div>
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

@endsection
