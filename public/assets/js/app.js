const openButtonGroup = document.getElementById("crear-group");
const closeButtonGroup = document.getElementById("close-modal-group");
const modalGroup = document.getElementById("task-modal-group");

openButtonGroup.addEventListener("click", () => {
  modalGroup.classList.remove("hidden");
});

closeButtonGroup.addEventListener("click", () => {
  modalGroup.classList.add("hidden");
});

const openButtonSection = document.getElementById("crear-section");
const closeButtonSection = document.getElementById("close-modal-section");
const modalSection = document.getElementById("task-modal-section");

openButtonSection?.addEventListener("click", () => {
  modalSection.classList.remove("hidden");
});

closeButtonSection?.addEventListener("click", () => {
  modalSection.classList.add("hidden");
});

document.getElementById("add-task").addEventListener("click", () => {
  document.getElementById("task-modal").classList.toggle("hidden");
});

//Grupos tres puntos
document.querySelectorAll(".menu-toggle").forEach((button) => {
  button.addEventListener("click", () => {
    const container = button.closest(".menu-container");
    const popup = container.querySelector(".menu-popup");

    document.querySelectorAll(".menu-popup").forEach((menu) => {
      if (menu !== popup) {
        menu.classList.add("hidden");
      }
    });

    popup.classList.toggle("hidden");
  });
});

document.addEventListener("click", (e) => {
  if (!e.target.closest(".menu-toggle") && !e.target.closest(".menu-popup")) {
    document.querySelectorAll(".menu-popup").forEach((menu) => {
      menu.classList.add("hidden");
    });
  }
});

