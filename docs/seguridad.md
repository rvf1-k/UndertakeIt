# Seguridad aplicada

Durante el desarrollo de UndertakeIt se han aplicado diferentes medidas para mejorar la seguridad de la aplicación y proteger la información de los usuarios.

## Autenticación de usuarios

El acceso a las funcionalidades privadas de la aplicación requiere que el usuario haya iniciado sesión correctamente.

Las contraseñas no se almacenan en texto plano, sino utilizando funciones de hash proporcionadas por PHP.

---

## Control de permisos

La aplicación incorpora un sistema de roles dentro de los grupos para limitar las acciones que puede realizar cada usuario.

Los permisos son verificados antes de ejecutar operaciones que requieren autorización específica.

Los roles disponibles son:

* Owner
* Admin
* Editor
* Lector

---

## Validación de datos

Los formularios incluyen validaciones tanto en cliente como en servidor.

Entre las validaciones aplicadas se encuentran:

* Comprobación de campos obligatorios.
* Restricciones de longitud.
* Validación mediante expresiones regulares (Regex).
* Comprobación del formato de determinados datos.

---

## Protección frente a SQL Injection

El acceso a la base de datos se realiza mediante consultas preparadas utilizando PDO. Los valores proporcionados por el usuario se envían como parámetros independientes de la consulta SQL, evitando su ejecución como código.

Ejemplo:

```php
$stmt = $conexion->prepare(
    "UPDATE grupo_usuario
     SET baneado = 0
     WHERE grupo_id = :groupId
       AND user_id = :userId"
);

$stmt->execute([
    ':groupId' => $groupId,
    ':userId' => $userId
]);
```


## Gestión de errores

La aplicación controla diferentes situaciones de error para evitar comportamientos inesperados y mejorar la experiencia de usuario.

En el entorno de producción la visualización de errores de PHP se encuentra deshabilitada para evitar la exposición de información sensible sobre el sistema.
