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

openButtonSection.addEventListener("click", () => {
    modalSection.classList.remove("hidden");
});

closeButtonSection.addEventListener("click", () => {
    modalSection.classList.add("hidden");
});