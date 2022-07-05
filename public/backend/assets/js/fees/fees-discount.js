$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-fees-discount").on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var name = $("#name").val();
        var discount_code = $("#discount-code").val();
        var amount = $("#amount").val();
        var description = $("#description").val();

        if (name == "") {
            $("#name").addClass("has-error");
            $("#name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (discount_code == "") {
            $("#discount-code").addClass("has-error");
            $("#discount-code").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (amount == "") {
            $("#amount").addClass("has-error");
            $("#amount").after("<span class='error'>This field is required.</span>");
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