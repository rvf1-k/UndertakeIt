document.addEventListener("click", (e) => {
  const button = e.target.closest(".menu-toggle");

  if (!button) {
    document.querySelectorAll(".menu-popup").forEach((menu) => {
      menu.classList.add("hidden");
    });

    return;
  }

  const container = button.closest(".menu-container");
  const popup = container.querySelector(".menu-popup");

  document.querySelectorAll(".menu-popup").forEach((menu) => {
    if (menu !== popup) {
      menu.classList.add("hidden");
    }
  });

  popup.classList.toggle("hidden");
});