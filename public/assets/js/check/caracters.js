$("input, textarea").attr("maxlength", 255);

$("input, textarea").on("input", function () {

    if ($(this).val().length >= 255) {

        $(this).attr("placeholder", "Máximo 255 caracteres");

    }

});

function validate(input, regex) {

    if (!regex.test(input.val())) {
        input.addClass("border-red-500");
        return false;
    }

    input.removeClass("border-red-500");
    return true;
}

validate($("input[name='username']"), /^[a-zA-Z0-9_]{3,20}$/);

validate($("input[name='email']"), /^[^\s@]+@[^\s@]+\.[^\s@]+$/);

validate($("input[name='password']"), /^(?=.*[A-Za-z])(?=.*\d).{8,}$/);