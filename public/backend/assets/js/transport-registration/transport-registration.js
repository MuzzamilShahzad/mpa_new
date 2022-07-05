$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-transport-registration").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var vehicle_id = $("#vehicle-id").val();
        var route_id = $("#route-id").val();
        var driver_id = $("#driver-id").val();
        var shift_id = $("#shift-id").val();
        var campus_id = $("#campus-id").val();
        var student_id = $("#student-id").val();
        var fees = $("#fees").val();
        var joining_date = $("#joining-date").val();

        if (vehicle_id == "") {
            $("#vehicle-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#vehicle-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (route_id == "") {
            $("#route-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#route-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (driver_id == "") {
            $("#driver-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#driver-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (shift_id == "") {
            $("#shift-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#shift-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (student_id == "") {
            $("#student-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#student-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (fees == "") {
            $("#fees").addClass("has-error");
            $("#fees").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (joining_date == "") {
            $("#joining-date").addClass("has-error");
            $("#joining-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-transport-registration").addClass('disabled');
            $("#btn-add-transport-registration").html('. . . . .');

            var message = '';
            var formData = {
                "vehicle_id": vehicle_id,
                "route_id": route_id,
                "driver_id": driver_id,
                "shift_id": shift_id,
                "student_id": student_id,
<<<<<<< HEAD
                "campus_id": campus_id,
=======
>>>>>>> 006a8d57bfecdb2a0392125c7eb641346cd1130d
                "fees": fees,
                "joining_date": joining_date
            };

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {

                                    if (key === 'fees' || key === 'joining_date') {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Success!</strong> `+ response.message + `
                                        </div>`;
                        }
                    } else {

                        $("#vehicle-id, #route-id, #driver-id, #shift-id, #campus-id, #student-id").val('').change();
                        $("#fees, #joining-date").val('');

                        message += `<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong> Success!</strong> `+ response.message + `
                                    </div>`;
                    }
                },
                error: function () {
                    message = `<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                                </div>`;
                },
                complete: function () {

                    if (message !== '') {
                        $("form").prepend(message);
                        setTimeout(function () {
                            $(".alert").remove();
                        }, 4000);
                    }

                    $("#btn-add-transport-registration").removeClass('disabled');
                    $("#btn-add-transport-registration").html('Submit');
<<<<<<< HEAD
=======

>>>>>>> 006a8d57bfecdb2a0392125c7eb641346cd1130d
                }
            });
        }
    });
    // End data store script






    // Start data update script
    $("#btn-update-transport-registration").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var vehicle_id = $("#vehicle-id").val();
        var route_id = $("#route-id").val();
        var driver_id = $("#driver-id").val();
        var shift_id = $("#shift-id").val();
        var campus_id = $("#campus-id").val();
        var student_id = $("#student-id").val();
        var fees = $("#fees").val();
        var joining_date = $("#joining-date").val();

        if (vehicle_id == "") {
            $("#vehicle-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#vehicle-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (route_id == "") {
            $("#route-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#route-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (driver_id == "") {
            $("#driver-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#driver-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (shift_id == "") {
            $("#shift-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#shift-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (student_id == "") {
            $("#student-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#student-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (fees == "") {
            $("#fees").addClass("has-error");
            $("#fees").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (joining_date == "") {
            $("#joining-date").addClass("has-error");
            $("#joining-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-transport-registration").addClass('disabled');
            $("#btn-update-transport-registration").html('. . . . .');

            var message = '';
            var formData = {
                "vehicle_id": vehicle_id,
                "route_id": route_id,
                "driver_id": driver_id,
                "shift_id": shift_id,
                "student_id": student_id,
                "campus_id": campus_id,
                "fees": fees,
                "joining_date": joining_date
            };

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {

                                    if (key === 'fees' || key === 'joining_date') {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Success!</strong> `+ response.message + `
                                        </div>`;
                        }
                    } else {

                        message += `<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong> Success!</strong> `+ response.message + `
                                    </div>`;
                    }
                },
                error: function () {
                    message = `<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                                </div>`;
                },
                complete: function () {

                    if (message !== '') {
                        $("form").prepend(message);
                        setTimeout(function () {
                            $(".alert").remove();
                        }, 4000);
                    }
                    $("#btn-update-transport-registration").removeClass('disabled');
                    $("#btn-update-transport-registration").html('Updated');

                }
            });
        }
    });
    // End data update script







    // Start Delete Data Script
    $(document).on('click', '#btn-delete-transport-registration', function () {

        var trans_reg_id = $(this).data('id');
        var url = baseUrl + '/transport/registration/delete';
        var row = $(this).parent().parent("tr");

        swal.fire({

            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this record',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 300,
            allowOutsideClick: false

        }).then(function (result) {

            if (result.value) {

                var message;
                // console.log(message);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { trans_reg_id: trans_reg_id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == false) {

                            message = {
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            };

                            // message += `<div class="alert alert-danger alert-dismissible">
                            //                 <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            //                 <strong> Success!</strong> `+ response.message + `
                            //             </div>`;

                        } else {
                            row.remove();

                            message = {
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                // showConfirmButton: false,
                                // timer: 1500
                            }
                            // console.log(message);

                            // message += `<div class="alert alert-success alert-dismissible">
                            //                 <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            //                 <strong> Success!</strong> `+ response.message + `
                            //             </div>`;
                        }
                    },

                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Some thing went wrong please contact to Administrator!',
                        })

                        // message = `<div class="alert alert-danger alert-dismissible">
                        //                 <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        //                 <strong> Oops! </strong> Some thing went wrong please contact to Administrator.
                        //             </div>`;
                    },

                    complete: function () {
                        Swal.fire({
                            icon: message.icon,
                            title: message.title,
                            text: message.text,
                        })

                        // $("#notifications").prepend(message);
                        // setTimeout(function () {
                        //     $(".alert").remove();
                        // }, 4000);
                    }
                });
            }
        });
    });
    // End Delete Data Script

    // Get Total Vehicle Capacity
    $(document).on('change', '#vehicle-id', function (e) {
        e.preventDefault();

        var vehicle_id = $('#vehicle-id').val();

        $.ajax({
            url: baseUrl + '/vehicle/total-capacity',
            type: "GET",
            data: { vehicle_id: vehicle_id },
            success: function (response) {
                // console.log(response.vehicle)

<<<<<<< HEAD
                if (response.vehicle[0]['total_students']) {

                    var remainingCapacity = response.totalCapacity - response.vehicle[0]['total_students'];

                    var html = '<label class="tx-semibold">Total Capacity</label>';
                    html += '<input class="form-control" value="' + response.totalCapacity + '" type="text" readonly>';
                    $('#total-capacity-input').html(html);

                    var html = '<label class="tx-semibold">Remaining Capacity</label>';
                    html += '<input class="form-control" value="' + remainingCapacity + '" type="text" readonly>';
                    $('#remaining-capacity-input').html(html);

                } else {

                    var remainingCapacity = response.totalCapacity - 0;

                    var html = '<label class="tx-semibold">Total Capacity</label>';
                    html += '<input class="form-control" value="' + response.totalCapacity + '" type="text" readonly>';
                    $('#total-capacity-input').html(html);

                    var html = '<label class="tx-semibold">Remaining Capacity</label>';
                    html += '<input class="form-control" value="' + remainingCapacity + '" type="text" readonly>';
                    $('#remaining-capacity-input').html(html);
                }
=======
                var remainingCapacity = response.totalCapacity - response.registerCount;
>>>>>>> 006a8d57bfecdb2a0392125c7eb641346cd1130d


<<<<<<< HEAD
=======
                var html = '<label class="tx-semibold">Remaining Capacity</label>';
                html += '<input class="form-control" value="' + remainingCapacity + '" type="text" readonly>';
                $('#remaining-capacity-input').html(html);
>>>>>>> 006a8d57bfecdb2a0392125c7eb641346cd1130d
            }
        });
    });

    // // Get Total Vehicle Capacity
    // $(document).on('change', '#shift-id', function () {

    //     var shift_id = $('#shift-id').val();

    //     $.ajax({
    //         url: baseUrl + '/vehicle/total-capacity',
    //         type: "GET",
    //         data: { shift_id: shift_id },
    //         success: function (response) {

    //             var remainingCapacity = response.totalCapacity - response.shiftWiseRegisterCount;

    //             var html = '<label class="tx-semibold">Total Capacity</label>';
    //             html += '<input class="form-control" value="' + response.totalCapacity + '" type="text" readonly>';
    //             $('#total-capacity-input').html(html);

    //             var html = '<label class="tx-semibold">Remaining Capacity</label>';
    //             html += '<input class="form-control" value="' + remainingCapacity + '" type="text" readonly>';
    //             $('#remaining-capacity-input').html(html);
    //         }
    //     });
    // });


});