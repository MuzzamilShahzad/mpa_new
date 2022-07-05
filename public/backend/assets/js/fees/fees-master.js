$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-fees-master").on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var fees_month = $("#fees-month").val();
        var campus_id = $("#campus-id").val();
        var fees_type_id = $("#fees-type-id").val();
        var session_id = $("#session-id").val();
        var class_id = $("#class-id").val();
        var category = $("#category").val();
        var due_date = $("#due-date").val();
        var amount = $("#amount").val();

        if (fees_month == "") {
            $("#fees-month").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#fees-month").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (fees_type_id == "") {
            $("#fees-type-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#fees-type-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (session_id == "") {
            $("#session-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (class_id == "") {
            $("#class-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#class-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (category == "") {
            $("#category").addClass("has-error");
            $("#category").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (due_date == "") {
            $("#due-date").addClass("has-error");
            $("#due-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (amount == "") {
            $("#amount").addClass("has-error");
            $("#amount").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

    });
    // End data store script

});