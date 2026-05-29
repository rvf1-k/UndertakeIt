// Convierte las imágenes en ventanas emergentes usando Fancybox

$(document).ready(function () {

  $(".fancybox-img").each(function (index) {

    const src = $(this).attr("src");

    $(this).wrap(
      '<a data-fancybox="gallery-' + index + '" href="' + src + '"></a>'
    );

  });

  Fancybox.bind("[data-fancybox]", {

    animated: true,

    showClass: "fancybox-fadeIn",

    hideClass: "fancybox-fadeOut",

  });

});