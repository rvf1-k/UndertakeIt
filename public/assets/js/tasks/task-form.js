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

$(document).ready(function() {
    var ahora = new Date();

    var año = ahora.getFullYear();
    var mes = String(ahora.getMonth() + 1).padStart(2, '0'); // Los meses van de 0 a 11
    var dia = String(ahora.getDate()).padStart(2, '0');
    var hora = String(ahora.getHours()).padStart(2, '0');
    var minutos = String(ahora.getMinutes()).padStart(2, '0');

    var fechaFormateada = `${año}-${mes}-${dia}T${hora}:${minutos}`;

    $('#fecha_inicio').val(fechaFormateada);
});