// Abre o cierra el menú de opciones con animación

$(document).on("click", function (e) {

    const button = $(e.target).closest(".menu-toggle");

    if (!button.length) {
        $(".menu-popup:visible").fadeOut(150);

        return;
    }

    const container = button.closest(".menu-container");

    const popup = container.find(".menu-popup");

    // Cierra los demás menús
    $(".menu-popup")
        .not(popup)
        .fadeOut(150);

    // Alterna el actual
    popup.stop(true, true).fadeToggle(150);

});