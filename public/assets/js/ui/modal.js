// Abre y cierra modales usando sus IDs

function createModal(openId, closeId, modalId) {

  const modal = $("#" + modalId);

  if (!modal.length) {
    return;
  }

  $("#" + openId).on("click", function () {

    modal.removeClass("hidden");

  });

  $("#" + closeId).on("click", function () {

    modal.addClass("hidden");

  });

}

createModal(
  "crear-group",
  "close-modal-group",
  "task-modal-group"
);

createModal(
  "crear-section",
  "close-modal-section",
  "task-modal-section"
);

createModal(
  "add-task",
  "close-modal-task",
  "task-modal"
);