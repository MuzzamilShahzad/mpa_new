$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Statrt Store data script
    $("#btn-add-contractor").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var area = $("#area").val();
        var cnic = $(" #cnic").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (area == "") {
            $("#area").addClass("has-error");
            $("#area").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (cnic == "") {
            $("#cnic").addClass("has-error");
            $("#cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-contractor").addClass('disabled');
            $("#btn-add-contractor").html('. . . . .');

            var message = '';
            var formData = {
                "name": name,
                "area": area,
                "cnic": cnic,
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

                                    $("input[name='" + key + "']").addClass("has-error");
                                    $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");

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

                        $("#name, #area, #cnic").val('');

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

                    $("#btn-add-contractor").removeClass('disabled');
                    $("#btn-add-contractor").html('Submitted');
                }
            });
        }
    });
    // End Store data script




    // Start Update Data Script
    $("#btn-update-contractor").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var area = $("#area").val();
        var cnic = $(" #cnic").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error '>This field is required.</span>");
            flag = false;
        }

        if (area == "") {
            $("#area").addClass("has-error");
            $("#area").after("<span class='error '>This field is required.</span>");
            flag = false;
        }

        if (cnic == "") {
            $("#cnic").addClass("has-error");
            $("#cnic").after("<span class='error '>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-contractor").addClass('disabled');
            $("#btn-update-contractor").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "name": name, "area": area, "cnic": cnic },
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
                                    $("#" + key).after("<span class='error '>" + value.toString().replace(',', '<br>') + "</span>");

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
                        // $("#area").val('');
                        // $("#cnic").val('');

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
                    $("#btn-update-contractor").removeClass('disabled');
                    $("#btn-update-contractor").html('updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End Update Data Script





    // Start Delete Data Script
    $(document).on('click', '#btn-delete-contractor', function () {

        var contractor_id = $(this).data('id');
        var url = baseUrl + '/contractor/delete';
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
                    data: { contractor_id: contractor_id },
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