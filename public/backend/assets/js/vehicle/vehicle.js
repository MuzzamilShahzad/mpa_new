$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-vehicle").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var maker = $("#maker").val();
        var vehicle_number = $("#vehicle-number").val();
        var capacity = $("#capacity").val();
        var engine_number = $("#engine-number").val();
        var contractor_id = $("#contractor-id").val();
        var chassis_number = $("#chassis-number").val();

        if (vehicle_number == "") {
            $("#vehicle-number").addClass("has-error");
            $("#vehicle-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (maker == "") {
            $("#maker").addClass("has-error");
            $("#maker").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (chassis_number == "") {
            $("#chassis-number").addClass("has-error");
            $("#chassis-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (engine_number == "") {
            $("#engine-number").addClass("has-error");
            $("#engine-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (capacity == "") {
            $("#capacity").addClass("has-error");
            $("#capacity").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-vehicle").addClass('disabled');
            $("#btn-add-vehicle").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "vehicle_number": vehicle_number, "maker": maker, "chassis_number": chassis_number, "engine_number": engine_number, "capacity": capacity, "contractor_id": contractor_id, },
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        // console.log(JSON.stringify(response.error).length);
                        // console.log(Object.keys(response.error).length);
                        // console.log(response.error);
                        // console.log($.parseJSON(response.error));

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

                                    // $("input[name='" + key + "']").addClass("has-error");
                                    $("#" + key).addClass("has-error");
                                    $("#" + key).after("<span class='error text-danger'>" + value.toString().replace(',', '<br>') + "</span>");

                                    message += `<li>` + value + `</li>`
                                });
                                message += `</ul>
                                    </div>`;
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong> Success!</strong> `+ response.message + `
                                            </div>`;
                        }
                    } else {

                        $("#vehicle-number").val('');
                        $("#maker").val('');
                        $("#chassis-number").val('');
                        $("#engine-number").val('');
                        $("#capacity").val('');
                        $("#contractor-id").val('').change();

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

                    $("form").prepend(message);
                    $("#btn-add-vehicle").removeClass('disabled');
                    $("#btn-add-vehicle").html('Submit');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script






    // Start data update script
    $("#btn-update-vehicle").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var maker = $("#maker").val();
        var vehicle_number = $("#vehicle-number").val();
        var capacity = $("#capacity").val();
        var engine_number = $("#engine-number").val();
        var contractor_id = $("#contractor-id").val();
        var chassis_number = $("#chassis-number").val();

        if (vehicle_number == "") {
            $("#vehicle-number").addClass("has-error");
            $("#vehicle-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (maker == "") {
            $("#maker").addClass("has-error");
            $("#maker").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (chassis_number == "") {
            $("#chassis-number").addClass("has-error");
            $("#chassis-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (engine_number == "") {
            $("#engine-number").addClass("has-error");
            $("#engine-number").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (capacity == "") {
            $("#capacity").addClass("has-error");
            $("#capacity").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-vehicle").addClass('disabled');
            $("#btn-update-vehicle").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "vehicle_number": vehicle_number, "maker": maker, "chassis_number": chassis_number, "engine_number": engine_number, "capacity": capacity, "contractor_id": contractor_id, },
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        // console.log(JSON.stringify(response.error).length);
                        // console.log(Object.keys(response.error).length);
                        // console.log(response.error);
                        // console.log($.parseJSON(response.error));

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

                                    // $("input[name='"+key+"']").addClass("has-error");
                                    $("#" + key).addClass("has-error");
                                    $("#" + key).after("<span class='error text-danger'>" + value.toString().replace(',', '<br>') + "</span>");

                                    message += `<li>` + value + `</li>`
                                });
                                message += `</ul>
                                    </div>`;
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong> Success!</strong> `+ response.message + `
                                            </div>`;
                        }
                    } else {

                        // $("#vehicle-number").val('');
                        // $("#maker").val('');
                        // $("#chassis-number").val('');
                        // $("#engine-number").val('');
                        // $("#capacity").val('');
                        // $("#contractor_id").val('');

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

                    $("form").prepend(message);
                    $("#btn-update-vehicle").removeClass('disabled');
                    $("#btn-update-vehicle").html('Updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data update script




    // Start data delete script
    $(document).on('click', '#btn-delete-vehicle', function () {
        // console.log('sadasd');

        var vehicle_id = $(this).data('id');
        // console.log(vehicle_id);
        var url = baseUrl + '/vehicle/delete';
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

                // var message = '';

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { vehicle_id: vehicle_id },
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
    // End data delete script
});
