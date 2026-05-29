$("input, textarea").attr("maxlength", 255);

$("input, textarea").on("input", function () {
  if ($(this).val().length >= 255) {
    $(this).attr("placeholder", "Máximo 255 caracteres");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const passwordInput = document.getElementById("password");

  // Regex simple: Al menos una letra (?=.*[a-zA-Z]), un número (?=.*\d) y mínimo 8 caracteres .{8,}
  const regex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

  // Validamos cuando el usuario hace clic fuera del input (blur)
  passwordInput.addEventListener("blur", () => {
    const password = passwordInput.value;

    // Si está vacío, no hace nada
    if (password === "") return;

    if (regex.test(password)) {
      // Si es correcta, quitamos estilos de error
      passwordInput.classList.remove("border-red-500");
    } else {
      // Si es incorrecta: borra el texto, cambia el placeholder y pinta el borde de rojo
      passwordInput.value = "";
      passwordInput.placeholder =
        "8 caracteres, letras y numeros";
      passwordInput.classList.add("border-red-500");
    }
  });

  // Opcional: Si vuelve a hacer clic para escribir, restauramos el borde original
  passwordInput.addEventListener("focus", () => {
    passwordInput.classList.remove("border-red-500");
  });
});
