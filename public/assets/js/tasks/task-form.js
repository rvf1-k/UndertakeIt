// Carga los usuarios del grupo seleccionado automáticamente

$(document).on("change", "#sectionSelect", async function () {

  const selectedOption =
    $(this).find(":selected");

  const groupId =
    selectedOption.data("group-id");

  const response = await fetch(
    "tasks/users-by-group?id=" + groupId
  );

  const users = await response.json();

  if (users.length == 0) {

    $("#userSelect").html(`
      <option
        disabled
        selected
        value="self">

        Sin grupo asignado

      </option>
    `);

    return;
  }

  if (users.length == 1) {

    $("#userSelect").html(`
      <option
        selected
        value="${users[0].user_id}">

        ${users[0].username}

      </option>
    `);

    return;
  }

  $("#userSelect").html(`
    <option
      disabled
      selected
      value="">

      Selecciona usuarios

    </option>
  `);

  users.forEach((user) => {

    $("#userSelect").append(`
      <option value="${user.user_id}">
        ${user.username}
      </option>
    `);

  });

});