# UndertakeIt

Aplicación web de gestión de tareas desarrollada en PHP siguiendo el patrón MVC.

## Requisitos

- PHP 8.0 o superior
- MySQL/MariaDB
- Composer

## Instalación

### 1. Instalar dependencias

```bash
composer install
```

### 2. Crear la base de datos

Importar el archivo SQL proporcionado en la carpeta `database`.

### 3. Configurar la conexión

Modificar los datos de conexión en:

```txt
config/database.php
```

## 4. Configuración de rutas

Durante el desarrollo local la aplicación se ejecutó en:

http://localhost/undertakeit/public

Por este motivo algunas rutas y redirecciones utilizan el prefijo:

/undertakeit/public

Si la aplicación se despliega en otra ubicación, puede ser necesario adaptar dichas rutas al nuevo entorno.

## Funcionalidades principales

- Gestión de tareas
- Gestión de categorías
- Gestión de hábitos
- Sistema de usuarios
- Personalización visual
- Generación de PDF mediante DomPDF

## Dependencias

Instaladas mediante Composer:

- DomPDF

---
Desarrollado como proyecto final de Desarrollo de Aplicaciones Web (DAW).