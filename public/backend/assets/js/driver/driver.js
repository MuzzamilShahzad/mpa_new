$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start store data script  
    $("#btn-add-driver").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var cnic = $("#cnic").val();
        var address = $("#address").val();
        var license_no = $("#license-no").val();
        var joining_date = $("#joining-date").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (address == "") {
            $("#address").addClass("has-error");
            $("#address").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (cnic == "") {
            $("#cnic").addClass("has-error");
            $("#cnic").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (license_no == "") {
            $("#license-no").addClass("has-error");
            $("#license-no").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (joining_date == "") {
            $("#joining-date").addClass("has-error");
            $("#joining-date").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-driver").addClass('disabled');
            $("#btn-add-driver").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "name": name, "address": address, "cnic": cnic, "license_no": license_no, "joining_date": joining_date },
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

                        $("#name").val('');
                        $("#address").val('');
                        $("#cnic").val('');
                        $("#license-no").val('');
                        $("#joining-date").val('');

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
                    $("#btn-add-driver").removeClass('disabled');
                    $("#btn-add-driver").html('Submited');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End store data script





    // Start update data script
    $("#btn-update-driver").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var cnic = $("#cnic").val();
        var address = $("#address").val();
        var license_no = $("#license-no").val();
        var joining_date = $("#joining-date").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (address == "") {
            $("#address").addClass("has-error");
            $("#address").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (cnic == "") {
            $("#cnic").addClass("has-error");
            $("#cnic").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (license_no == "") {
            $("#license-no").addClass("has-error");
            $("#license-no").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (joining_date == "") {
            $("#joining-date").addClass("has-error");
            $("#joining-date").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-driver").addClass('disabled');
            $("#btn-update-driver").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "name": name, "address": address, "cnic": cnic, "license_no": license_no, "joining_date": joining_date },
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

                        // $("#name").val('');
                        // $("#address").val('');
                        // $("#cnic").val('');
                        // $("#license_no").val('');
                        // $("#joining_date").val('');

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
                    $("#btn-update-driver").removeClass('disabled');
                    $("#btn-update-driver").html('Submited');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End update data script






    // Start Delete Data Script
    $(document).on('click', '#btn-delete-driver', function () {

        var driver_id = $(this).data('id');
        var url = baseUrl + '/driver/delete';
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
                    data: { driver_id: driver_id },
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

});
