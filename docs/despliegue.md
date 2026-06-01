# Despliegue

## Hosting utilizado

Para el despliegue de UndertakeIt se ha utilizado InfinityFree como proveedor de alojamiento web.

La elección de este servicio se realizó principalmente por ofrecer un plan gratuito con características suficientes para los requisitos del proyecto, entre las que destacan:

* 5 GB de almacenamiento.
* Ancho de banda ilimitado.
* Posibilidad de alojar múltiples dominios.
* Acceso mediante FTP.
* Soporte para PHP y MySQL.

Estas características permiten desplegar y demostrar el funcionamiento de la aplicación sin necesidad de contratar un servicio de alojamiento de pago.

---

## Adaptaciones realizadas para el despliegue

Debido a las limitaciones propias del servicio de alojamiento utilizado, fue necesario realizar pequeñas modificaciones en la estructura del proyecto respecto al entorno de desarrollo.

Principalmente, el servicio de alojamiento utilizado no permitía configurar el directorio raíz del sitio web para que apuntara directamente a dicha carpeta y el resto de la aplicación tuvo que simplificarse para adaptarse a la estructura soportada por el hosting.

Estas modificaciones no afectan al funcionamiento de la aplicación ni a la organización lógica del código.

> [!NOTE]
> Para ver sobre la nueva estructura del proyecto en [Arquitectura](./arquitectura.md/#entorno-de-desarrollo).
