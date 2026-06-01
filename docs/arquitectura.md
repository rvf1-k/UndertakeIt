# Arquitectura del proyecto

## Estructura general

UndertakeIt está organizado siguiendo una estructura inspirada en el patrón Modelo-Vista-Controlador (MVC), separando la lógica de negocio, el acceso a datos y la interfaz de usuario en diferentes directorios.

```text
app/
├── controllers/
├── helpers/
├── models/
└── views/
    ├── components/
    ├── layouts/
    └── pages/

config/
database/
docs/
public/
```

---

## Directorio app

El directorio `app` contiene la mayor parte del código fuente de la aplicación.

### Controllers

Los controladores reciben las peticiones del usuario, procesan la información necesaria y coordinan la comunicación entre los modelos y las vistas.

### Models

Los modelos encapsulan la lógica de acceso a la base de datos y representan las diferentes entidades de la aplicación, como usuarios, tareas o grupos.

### Views

Las vistas contienen la interfaz mostrada al usuario.

Se encuentran divididas en tres categorías:

#### Components

Elementos reutilizables utilizados en distintas partes de la aplicación.

#### Layouts

Plantillas generales que definen la estructura común de las páginas.

#### Pages

Vistas específicas correspondientes a cada sección de la aplicación.

### Helpers

Contiene funciones auxiliares reutilizables empleadas en distintos puntos del proyecto.

---

## Directorio config

Almacena la configuración general de la aplicación, incluyendo parámetros de conexión y variables necesarias para su funcionamiento.

---

## Directorio database

Contiene los scripts relacionados con la base de datos y la estructura necesaria para la persistencia de la información.

---

## Directorio docs

Incluye la documentación técnica y funcional del proyecto desarrollada en formato Markdown.

---

## Directorio public

Es el directorio accesible desde el navegador.

Contiene los recursos estáticos de la aplicación:

* Hojas de estilo CSS.
* Archivos JavaScript.
* Imágenes.
* Archivos subidos por los usuarios.

Además, actúa como punto de entrada principal de la aplicación.

---

## Entorno de desarrollo

## Diferencias entre desarrollo y producción

Durante el desarrollo se utilizó una estructura inspirada en MVC para facilitar la organización del código y la separación de responsabilidades.

Debido a las limitaciones del servicio de alojamiento utilizado para el despliegue, fue necesario realizar algunas modificaciones en la estructura de directorios. Principalmente, los archivos públicos tuvieron que integrarse dentro de la estructura principal de la aplicación al no poder utilizar una carpeta pública independiente.

La estructura utilizada en producción es la siguiente:

```text
undertakeit/
│
├── app/
│   ├── controllers/
│   ├── helpers/
│   ├── models/
│   └── views/
│       ├── components/
│       ├── layouts/
│       └── pages/
│
├── config/
├── database/
├── docs/
│
├── assets/
│   ├── css/
│   ├── img/
│   └── js/
│
├── uploads/
│
├── vendor/
│
├── index.php
├── .htaccess
└── composer.json
```

Estas modificaciones fueron realizadas únicamente para adaptarse a las restricciones del entorno de alojamiento y no afectan al funcionamiento de la aplicación.


> [!NOTE]
> Para ver sobre el despliegue del proyecto en [Despliegue](./despliegue.md/#adaptaciones-realizadas-para-el-despliegue).
