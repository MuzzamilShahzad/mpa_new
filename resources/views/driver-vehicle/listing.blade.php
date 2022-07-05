@extends('layouts.app')
@section('main-content')
@section('page_title', 'Manage Driver Vehicle')

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
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <a href="{{ route('driver-vehicle.create') }}" class="btn btn-primary" style="float:right">Add Driver Vehicle</a>
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
                                            <th>Vehicle</th>
                                            <th>Route</th>
                                            <th>Driver</th>
                                            <th>Shift Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($driverVehicle as $sno => $item)
                                        <tr id="did{{$item->id}}">
                                            <td>{{ $sno + 1 }}</td>
                                            <td>{{$item->vehicle->maker}}</td>
                                            <td>{{$item->route->area}}</td>
                                            <td>{{$item->driver->name}}</td>
                                            <td>{{$item->shift->timings}}</td>
                                            <td>
                                                <a href="{{ route('driver-vehicle.edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <button data-id="{{$item->id}}" id="deleteDriver" class="btn btn-danger btn-sm">Delete</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click','#deleteDriver', function(){
                    var driver_id = $(this).data('id');
                    var url = '<?= route("driver.delete") ?>'
                    // alert(driver_id);
                
                    swal.fire({
                         title:'Are you sure?',
                         html:'You want to <b>delete</b> this record',
                         showCancelButton:true,
                         showCloseButton:true,
                         cancelButtonText:'Cancel',
                         confirmButtonText:'Yes, Delete',
                         cancelButtonColor:'#d33',
                         confirmButtonColor:'#556ee6',
                         width:300,
                         allowOutsideClick:false
                    }).then(function(result){
                          if(result.value){
                              $.post(url,{driver_id:driver_id}, function(data){
                                   if(data.code == 1){
                                       $('#responsive-datatable').DataTable().ajax.reload(null, false);
                                       toastr.success(data.message);
                                   }else{
                                       toastr.error(data.message);
                                   }
                              },'json');
                          }
                    });

                });

</script>



@endsection
