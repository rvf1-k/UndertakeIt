// Elimina partes de la interfaz en login, register y showcase

const params = new URLSearchParams(window.location.search);

const page = params.get("page");

const isWelcomePage =
  page === "login" || page === "register" || page === "showcase";

if (isWelcomePage) {
  $("#navbar-aside").remove();

  $("#global-header").remove();

  $("#global-nav").remove();
}
