$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-fees-type").on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var campus_id = $("#campus-id").val();
        var name = $("#name").val();
        var fees_code = $("#fees-code").val();
        var description = $("#description").val();

        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (fees_code == "") {
            $("#fees-code").addClass("has-error");
            $("#fees-code").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (description == "") {
            $("#description").addClass("has-error");
            $("#description").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

    });
    // End data store script

});