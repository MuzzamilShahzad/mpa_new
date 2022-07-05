$(document).ready(function () {
    $("#btn-update-driver_vehicle").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var vehicle_id = $("#vehicle_id").val();
        var route_id = $("#route_id").val();
        var driver_id = $("#driver_id").val();
        var shift_time_id = $("#shift_time_id").val();

        if (vehicle_id == "") {
            $("#vehicle_id").addClass("has-error");
            $("#vehicle_id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (route_id == "") {
            $("#route_id").addClass("has-error");
            $("#route_id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (driver_id == "") {
            $("#driver_id").addClass("has-error");
            $("#driver_id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (shift_time_id == "") {
            $("#shift_time_id").addClass("has-error");
            $("#shift_time_id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-driver_vehicle").addClass('disabled');
            $("#btn-update-driver_vehicle").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "vehicle_id": vehicle_id, "route_id": route_id, "driver_id": driver_id, "shift_time_id": shift_time_id },
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

                        // $("#vehicle_id").val('');
                        // $("#route_id").val('');
                        // $("#driver_id").val('');
                        // $("#shift_time_id").val('');

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
                    $("#btn-update-driver_vehicle").removeClass('disabled');
                    $("#btn-update-driver_vehicle").html('Submit');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
});