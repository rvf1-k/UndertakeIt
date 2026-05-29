// Marca o desmarca una tarea automáticamente al cambiar el checkbox

$(document).on("change", ".task-checkbox", async function () {

  const taskId = $(this).data("task-id");

  const url = $(this).is(":checked")
    ? "tasks/check?id=" + taskId
    : "tasks/uncheck?id=" + taskId;

  await fetch(url);

});