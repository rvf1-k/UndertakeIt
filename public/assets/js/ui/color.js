$(document).ready(function() {
    $("#primary-color-picker").on("input", function () {
        const color = $(this).val();

        // Cambia el color en tiempo real
        document.documentElement.style.setProperty("--primary-color", color);

        document.cookie = "primary_color=" + encodeURIComponent(color) + "; path=/; max-age=" + (60*60*24*30);
    });
});