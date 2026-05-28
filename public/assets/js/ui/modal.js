function createModal(openId, closeId, modalId) {
  const openButton = document.getElementById(openId);
  const closeButton = document.getElementById(closeId);
  const modal = document.getElementById(modalId);

  if (!modal) return;

  openButton?.addEventListener("click", () => {
    modal.classList.remove("hidden");
  });

  closeButton?.addEventListener("click", () => {
    modal.classList.add("hidden");
  });
}

createModal("crear-group", "close-modal-group", "task-modal-group");

createModal("crear-section", "close-modal-section", "task-modal-section");

createModal("add-task", "close-modal-task", "task-modal");