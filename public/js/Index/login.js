$(document).ready(function () {
    $('#user_login').mask('000.000.000-00');
});

$(function () {
    var form = $(".login-form");

    form.css({
        opacity: 1,
        "-webkit-transform": "scale(1)",
        "transform": "scale(1)",
        "-webkit-transition": ".5s",
        "transition": ".5s"
    });
});