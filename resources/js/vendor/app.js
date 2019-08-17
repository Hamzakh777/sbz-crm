$(document).ready(function () {
    
    $(".datepicker--date-only").datetimepicker({
        format: "DD-MM-YYYY"
    });

    $(".datepicker--time-only").datetimepicker({
        format: "HH:mm"
    });

    // disable chaging the value by mouse scroll
    $("form").on("focus", "input[type=number]", function (e) {
        $(this).on("mousewheel.disableScroll", function (e) {
            e.preventDefault();
        });
    });
    $("form").on("blur", "input[type=number]", function (e) {
        $(this).off("mousewheel.disableScroll");
    });
});