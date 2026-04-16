CREATE TABLE `users` (
  `id` serial PRIMARY KEY,
  `username` varchar(50) UNIQUE,
  `email` varchar(255) UNIQUE,
  `password_hash` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `grupo_usuario` (
  `user_id` int,
  `grupo_id` int,
  `rol` ENUM ('admin', 'editor', 'lector'),
  `baneado` boolean,
  `fecha_baneo` timestamp,
  `motivo_baneo` varchar(255),
  `joined_at` timestamp,
  PRIMARY KEY (`user_id`, `grupo_id`)
);

CREATE TABLE `grupo` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255),
  `descripcion` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `seccion` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255),
  `descripcion` varchar(255),
  `grupo_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `tarea` (
  `id` serial PRIMARY KEY,
  `titulo` varchar(255),
  `descripcion` varchar(255),
  `fecha_inicio` timestamp,
  `fecha_fin` timestamp,
  `completada` boolean,
  `seccion_id` int,
  `parent_id` int COMMENT 'NULL si es tarea principal',
  `assigned_user_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

ALTER TABLE `grupo_usuario` COMMENT = 'Relacion muchos-a-muchos entre users y grupo';

ALTER TABLE `tarea` COMMENT = 'Subtareas mediante parent_id (self-reference)';

ALTER TABLE `grupo_usuario` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `grupo_usuario` ADD FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`);

ALTER TABLE `seccion` ADD FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`);

ALTER TABLE `tarea` ADD FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`);

ALTER TABLE `tarea` ADD FOREIGN KEY (`parent_id`) REFERENCES `tarea` (`id`);

ALTER TABLE `tarea` ADD FOREIGN KEY (`assigned_user_id`) REFERENCES `users` (`id`);
