$(document).on("click", ".btn-unBan", async function (e) {
  const userId = $(this).val();

  const groupId = $(this).data("group");

  const url = `users/unBan?user_id=${userId}&group_id=${groupId}`;

  await fetch(url);
});
