document.addEventListener("change", async (e) => {
  const checkbox = e.target.closest(".task-checkbox");

  if (!checkbox) return;

  const filtrer = checkbox.dataset.filtrer;

  const url = checkbox.checked
    ? "tasks/print-pdf?filtrer=" + filtrer
    : "tasks/print-pdf?filtrer=" + filtrer;

  await fetch(url);
});