@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Driver')

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
                            <a href="{{ route('driver.create') }}" class="btn btn-primary" style="float:right">Add Driver</a>
                            <div>
                                <h1 class="main-content-label mb-1">{{ $data['menu'] }} </h1>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th width="10px">S.NO</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>CNIC</th>
                                            <th>License No</th>
                                            <th>Joining Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['Driver'] as $sno => $item)
                                        <tr>
                                            <td>{{ $sno + 1 }}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->cnic}}</td>
                                            <td>{{$item->license_no}}</td>
                                            <td>{{$item->joining_date}}</td>
                                            <td>
                                                <a href="{{ route('driver.edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <button data-id="{{$item->id}}" id="btn-delete-driver" class="btn btn-danger btn-sm">Delete</button>
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

<script src="{{ url('assets/js/driver/driver.js') }}"></script>



@endsection
