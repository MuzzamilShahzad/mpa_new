const { forEach } = require("lodash");

$(document).ready(function () {

    var baseUrl = $(".base-url").val();


    $('body').on("click", ".btn-add-system", function (e) {

        var systemLength = $('.system option').length;
        var length = jQuery("div[id='system-details']").length + 1;

        var options = $(".system > option").clone();
        console.log(options);

        if (length < systemLength) {
            $(this).attr("class", "btn-remove-system");
            $(this).attr("alt", "remove-system");
            $(this).attr("src", "http://localhost/accounts/public/backend/assets/img/remove-icon.png");

            $('.btn-add-system-row').after(`<div class="form-row" id="system-details">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label class="tx-semibold">Select System</label>
                                                        <div class="pos-relative">
                                                            <select class="form-control select2">
                                                                <option value=''>Select..</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label class="tx-semibold">Short Name</label>
                                                        <div class="pos-relative">
                                                            <input name="short_name" class="form-control" type="text" placeholder="Enter Short Name" maxlength="10" id="short_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-2">
                                                    <div class="form-group">
                                                        <label class="form-label tx-semibold">Add </label>
                                                        <img class="btn-add-system img" alt="btn-add-system" src="http://localhost/accounts/public/backend/assets/img/add-icon.png">
                                                    </div>
                                                </div>
                                            </div>`);
        }
    });

    $('body').on("click", ".btn-remove-system", function (e) {
        $(this).parent().parent().parent().remove();
    });


    // Start data store script
    $("#btn-add-campus").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var short_name = $("#short_name").val();
        var system = $("#system").val();
        var logo = $("#logo").val();

        console.log(logo);

        var active_session = $("#active_session").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (email == "") {
            $("#email").addClass("has-error");
            $("#email").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (phone == "") {
            $("#phone").addClass("has-error");
            $("#phone").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (address == "") {
            $("#address").addClass("has-error");
            $("#address").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (active_session == "") {
            $("#active_session").addClass("has-error");
            $("#active_session").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (system == "") {
            $("#system").addClass("has-error");
            $("#system").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (short_name == "") {
            $("#short_name").addClass("has-error");
            $("#short_name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-campus").addClass('disabled');
            $("#btn-add-campus").html('. . . . .');

            var message = '';
            let formData = new FormData(document.getElementById('my-form'));
            $('#image-input-error').text('');

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

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

                        $("#campus").val('');

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
                    $("#btn-add-campus").removeClass('disabled');
                    $("#btn-add-campus").html('Submitted');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script

    // Start data update script
    $("#btn-update-campus").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var campus = $("#campus").val();

        if (campus == "") {
            $("#campus").addClass("has-error");
            $("#campus").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-campus").addClass('disabled');
            $("#btn-update-campus").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "campus": campus },
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

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
                    $("#btn-update-campus").removeClass('disabled');
                    $("#btn-update-campus").html('Updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data update script


    // Start Delete Data Script
    $(document).on('click', '#btn-delete-campus', function () {

        var campus_id = $(this).data('id');
        var url = baseUrl + '/campus/delete';
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
                    data: { campus_id: campus_id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == false) {

                            message = {
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            };

                        } else {
                            row.remove();

                            message = {
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }
                        }
                    },

                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Some thing went wrong please contact to Administrator!',
                        })
                    },

                    complete: function () {
                        Swal.fire({
                            icon: message.icon,
                            title: message.title,
                            text: message.text,
                        })
                    }
                });
            }
        });
    });
    // End Delete Data Script

});