// Muestra u oculta el contenido de una tarea al pulsar el botón

$(document).on("click", ".task-toggle", function () {

  const container = $(this).closest(".task-item");

  const content = container.find(".task-content");

  content.toggleClass("hidden");

});