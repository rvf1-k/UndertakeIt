$(document).on("click", ".btn-ban", async function (e) {
  const userId = $(this).val();

  const groupId = $(this).data("group");

  const url = `users/ban?user_id=${userId}&group_id=${groupId}`;

  await fetch(url);
});
