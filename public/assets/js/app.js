const openButton = document.getElementById("crear");
const closeButton = document.getElementById("close-modal");
const modal = document.getElementById("task-modal");

openButton.addEventListener("click", () => {
    modal.classList.remove("hidden");
});

closeButton.addEventListener("click", () => {
    modal.classList.add("hidden");
});