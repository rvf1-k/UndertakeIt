sectionSelect.addEventListener("change", async () => {
  const selectedOption = sectionSelect.selectedOptions[0];
  const groupId = selectedOption.dataset.groupId;

  const response = await fetch("tasks/users-by-group?id=" + groupId);

  const users = await response.json();

  console.log(users);
  if (users.length == 0) {
    userSelect.innerHTML =
      "<option disabled selected value='self'>Sin grupo asignado</option>";
    return;
  }

  console.log(users);

  if (users.length == 1) {
    userSelect.innerHTML = `<option selected value="${users[0].user_id}">
                ${users[0].username}
            </option>`;
    return;
  }

  userSelect.innerHTML =
    '<option disabled selected value="">Selecciona usuarios</option>';
  users.forEach((user) => {
    userSelect.innerHTML += `
            <option value="${user.user_id}">
                ${user.username}
            </option>
        `;
  });
});
