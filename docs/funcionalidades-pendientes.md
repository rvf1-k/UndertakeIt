# Funcionalidades pendientes

Durante el diseño y desarrollo de UndertakeIt se prepararon diversas funcionalidades que finalmente no pudieron implementarse dentro del tiempo disponible para el proyecto.

## Calendario

La aplicación incluye una vista reservada para la gestión de tareas mediante calendario. Sin embargo, esta funcionalidad no ha sido desarrollada en la versión actual.

La base de datos ya incorpora campos relacionados con fechas de inicio y finalización que facilitarían su futura implementación.

---

## Hábitos

La base de datos contempla la existencia de tareas de tipo hábito mediante el campo `tipo` de la entidad `tarea`.

No obstante, la interfaz y la lógica necesarias para gestionar hábitos de forma independiente no llegaron a implementarse.

---

## Subtareas y tareas recursivas

La entidad `tarea` incorpora un campo `parent_id` que permite establecer relaciones padre-hijo entre tareas.

Esta estructura permitiría crear subtareas y sistemas jerárquicos de organización, pero actualmente dicha funcionalidad no está disponible para los usuarios.

---

## Sistema de almacenamiento

El directorio `storage` fue planteado para almacenar distintos tipos de archivos generados por la aplicación.

Actualmente únicamente se utiliza para el almacenamiento de imágenes asociadas a las tareas.
