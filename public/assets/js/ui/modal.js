// Abre y cierra modales usando animaciones
function createModal(openId, closeId, modalId) {

    const modal = $("#" + modalId);

    if (!modal.length) {
        return;
    }

    $("#" + openId).on("click", function () {

        modal
            .removeClass("hidden")
            .hide()
            .fadeIn(200);

    });

    $("#" + closeId).on("click", function () {

        modal.fadeOut(200, function () {
            modal.addClass("hidden");
        });

    });

}

createModal("crear-group", "close-modal-group", "task-modal-group");

createModal("crear-section", "close-modal-section", "task-modal-section");

createModal("add-task-section", "close-modal-task", "task-modal");

createModal("add-task", "close-modal-task", "task-modal");

createModal("open-navbar-aside", "close-navbar-aside", "navbar-aside");
