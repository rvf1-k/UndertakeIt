-- =========================
-- USERS
-- =========================
CREATE TABLE `users` (
  `id` serial PRIMARY KEY,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(255) NOT NULL UNIQUE,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- GRUPO
-- =========================
CREATE TABLE `grupo` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================
-- GRUPO_USUARIO (roles por grupo)
-- =========================
CREATE TABLE `grupo_usuario` (
  `user_id` bigint unsigned NOT NULL,
  `grupo_id` bigint unsigned NOT NULL,
  `rol` ENUM ('owner', 'admin', 'editor', 'lector') NOT NULL DEFAULT 'lector',
  `baneado` boolean NOT NULL DEFAULT false,
  `fecha_baneo` timestamp NULL,
  `motivo_baneo` varchar(255) NULL,
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`, `grupo_id`),

  CONSTRAINT `fk_grupo_usuario_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE,

  CONSTRAINT `fk_grupo_usuario_grupo`
    FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`)
    ON DELETE CASCADE
);

ALTER TABLE `grupo_usuario`
  COMMENT = 'Relacion muchos-a-muchos entre users y grupo, con rol por grupo y soporte de baneo.';

-- =========================
-- SECCION
-- =========================
CREATE TABLE `seccion` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255),
  `grupo_id` bigint unsigned NOT NULL,
  `is_default` boolean NOT NULL DEFAULT false,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT `fk_seccion_grupo`
    FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`)
    ON DELETE CASCADE
);

-- =========================
-- TAREA (definición/plantilla)
-- - puntual: suele tener fecha_inicio/fecha_fin
-- - habito: se define por recurrencia y se "marca" por día en tarea_log
-- =========================
CREATE TABLE `tarea` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255),

  `tipo` ENUM ('puntual', 'habito') NOT NULL DEFAULT 'puntual',

  `fecha_inicio` timestamp NULL,
  `fecha_fin` timestamp NULL,

  -- Regla simple de recurrencia (puede ser 'daily', 'weekly:1,3,5', etc.)
  -- Si es NULL => no recurrente
  `recurrence_rule` varchar(255) NULL,

  `seccion_id` bigint unsigned NOT NULL,

  `parent_id` bigint unsigned NULL COMMENT 'NULL si es tarea principal (subtareas por self-reference)',

  -- Asignación opcional a un usuario (dentro del grupo)
  `assigned_user_id` bigint unsigned NULL,

  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT `fk_tarea_seccion`
    FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`)
    ON DELETE CASCADE,

  CONSTRAINT `fk_tarea_parent`
    FOREIGN KEY (`parent_id`) REFERENCES `tarea` (`id`)
    ON DELETE CASCADE,

  CONSTRAINT `fk_tarea_assigned_user`
    FOREIGN KEY (`assigned_user_id`) REFERENCES `users` (`id`)
    ON DELETE SET NULL
);

ALTER TABLE `tarea`
  COMMENT = 'Definicion de tareas puntuales y habitos. Las subtareas usan parent_id. Los completados por fecha van en tarea_log.';

-- =========================
-- TAREA_LOG (completados por día / ocurrencias)
-- Esto permite:
-- - rachas de habitos
-- - calendario por día
-- - historial (quién completó y cuándo)
-- =========================
CREATE TABLE `tarea_log` (
  `id` serial PRIMARY KEY,
  `tarea_id` bigint unsigned NOT NULL,
  `fecha` date NOT NULL,
  `completada` boolean NOT NULL DEFAULT true,
  `completed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_by_user_id` bigint unsigned NULL,

  -- Evita duplicados: una tarea solo puede tener 1 registro por día
  UNIQUE KEY `uq_tarea_log_tarea_fecha` (`tarea_id`, `fecha`),

  CONSTRAINT `fk_tarea_log_tarea`
    FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`)
    ON DELETE CASCADE,

  CONSTRAINT `fk_tarea_log_completed_by`
    FOREIGN KEY (`completed_by_user_id`) REFERENCES `users` (`id`)
    ON DELETE SET NULL
);