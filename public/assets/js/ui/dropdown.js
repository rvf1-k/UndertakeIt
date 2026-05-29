// Abre o cierra el menú de opciones al pulsar el botón

$(document).on("click", function (e) {

  const button =
    $(e.target).closest(".menu-toggle");

  if (!button.length) {

    $(".menu-popup").addClass("hidden");

    return;
  }

  const container =
    button.closest(".menu-container");

  const popup =
    container.find(".menu-popup");

  $(".menu-popup").not(popup).addClass("hidden");

  popup.toggleClass("hidden");

});