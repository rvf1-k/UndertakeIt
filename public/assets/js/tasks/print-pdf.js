// Envía el filtro seleccionado para generar el PDF automáticamente

$(document).on("change", ".task-checkbox", async function () {

  const filtrer = $(this).data("filtrer");

  const url =
    "tasks/print-pdf?filtrer=" + filtrer;

  await fetch(url);

});