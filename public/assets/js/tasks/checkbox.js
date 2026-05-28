document.addEventListener("change", async (e) => {
  const checkbox = e.target.closest(".task-checkbox");

  if (!checkbox) return;

  const taskId = checkbox.dataset.taskId;

  const url = checkbox.checked
    ? "tasks/check?id=" + taskId
    : "tasks/uncheck?id=" + taskId;

  await fetch(url);
});