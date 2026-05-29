---
layout: page
title: Guia de Estilo Web - UndertakeIt
permalink: /guia-estilo/
---
# Guía de Estilo Web — UndertakeIt

## 1. Estructura

La interfaz de UndertakeIt se organiza mediante **tarjetas (Cards)**.

Clases base de las Cards en Tailwind:

- `bg-white`
- `border border-gray-200`
- `shadow-sm`

Se usan bordes redondeados moderados con:

- `rounded-lg`

Sistema de espaciado recomendado para mantener una interfaz respirable (no compacta):

| Elemento                   | Espaciado                       |
| -------------------------- | ------------------------------- |
| Layout general             | `p-8`                         |
| Tarjetas                   | `p-5` / `p-6`               |
| Botones e inputs           | `px-4 py-3`                   |
| Separaciones entre bloques | `gap-4`, `gap-5`, `gap-8` |

## 2. Color

Base neutra del proyecto:

| Uso                | Clase Tailwind                            |
| ------------------ | ----------------------------------------- |
| Fondo general      | `bg-gray-100`                           |
| Tarjetas           | `bg-white`                              |
| Bordes             | `border-gray-200` / `border-gray-300` |
| Fondos secundarios | `bg-gray-50`                            |
| Texto principal    | `text-gray-800`                         |
| Texto secundario   | `text-gray-600`                         |

### Filosofía del color principal

**"El blanco organiza, el color identifica".**

El color personalizado seleccionado por el usuario/grupo se reserva para destacar:

- Elementos activos (checkboxes, botones principales, tags)
- Estados (`hover` suave, `focus`)
- Elementos emocionales (barras de progreso, hábitos completados)

### Lo que NO se debe hacer

- No usar el color principal en fondos completos
- No usarlo en tarjetas
- No usarlo en textos largos
- No usarlo en sombras

## 3. Tipografía

La tipografía debe ser limpia y neutral, con estética de productividad (estilo Notion/Todoist).

Jerarquía tipográfica:

- Títulos: `text-xl font-semibold`
- Texto normal y secundario: `text-sm text-gray-600`

El texto siempre debe mantenerse en un gris medio/oscuro para evitar fatiga visual.

## 4. Menús

Las interacciones en menús y botones deben ser rápidas y sutiles, usando:

- `transition`
- `hover:bg-gray-100`

Quedan prohibidas:

- Animaciones largas
- Rebotes
- Efectos llamativos tipo “gaming”

## 5. Imágenes y logotipos

La identidad visual de UndertakeIt busca una estética minimalista y privado, no tiene logo para ser más inpersonal.

Sombras permitidas para elementos e imágenes:

- `shadow-sm`
- Ocasionalmente `shadow-md`

Prohibido:

- `shadow-2xl`
- `drop-shadow`

## 6. Diseño responsivo. Puntos de ruptura

La estructura se adapta con los breakpoints estándar de Tailwind:

- **Móviles (`sm`, 640px):** layout más compacto, paddings reducidos a `p-4` y menús colapsables para aprovechar espacio.
- **Tablets (`md`, 768px):** el contenido empieza a organizarse en `grid` y los espaciados suben a `p-6`.
- **Escritorio (`lg`, 1024px / `xl`, 1280px):** se aplica el diseño completo del brief con layout `p-8`, barras laterales fijas para menú y distribución limpia.
