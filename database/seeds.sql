START TRANSACTION;

-- Si tienes FKs activas, esto evita errores durante el borrado.
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `tarea_log`;
TRUNCATE TABLE `tarea`;
TRUNCATE TABLE `seccion`;
TRUNCATE TABLE `grupo_usuario`;
TRUNCATE TABLE `grupo`;
TRUNCATE TABLE `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- =========================
-- USERS (5)
-- =========================
INSERT INTO `users` (`id`,`username`,`email`,`password_hash`,`created_at`) VALUES
(1,'ana','ana@demo.local','$2y$demo_hash',NOW()),
(2,'ben','ben@demo.local','$2y$demo_hash',NOW()),
(3,'carla','carla@demo.local','$2y$demo_hash',NOW()),
(4,'dani','dani@demo.local','$2y$demo_hash',NOW()),
(5,'elena','elena@demo.local','$2y$demo_hash',NOW());

-- =========================
-- GRUPO (1)
-- =========================
INSERT INTO `grupo` (`id`,`titulo`,`descripcion`,`created_at`,`updated_at`) VALUES
(1,'Demo','Grupo demo para pruebas',NOW(),NOW());

-- =========================
-- GRUPO_USUARIO (roles)
-- =========================
INSERT INTO `grupo_usuario`
(`user_id`,`grupo_id`,`rol`,`baneado`,`fecha_baneo`,`motivo_baneo`,`joined_at`) VALUES
(1,1,'owner',false,NULL,NULL,NOW()),
(2,1,'admin',false,NULL,NULL,NOW()),
(3,1,'editor',false,NULL,NULL,NOW()),
(4,1,'lector',false,NULL,NULL,NOW()),
(5,1,'lector',true,NOW(),'Baneo de prueba',NOW());

-- =========================
-- SECCIONES (2)
-- =========================
INSERT INTO `seccion` (`id`,`titulo`,`descripcion`,`grupo_id`,`is_default`,`created_at`,`updated_at`) VALUES
(1,'Default','Sección por defecto',1,true,NOW(),NOW()),
(2,'Hoy','Cosas para hoy',1,false,NOW(),NOW());

-- =========================
-- TAREAS PUNTUALES ÚNICAS (3+)
-- Fechas: ayer/hoy/mañana/pasado/futuro
-- =========================
INSERT INTO `tarea`
(`id`,`titulo`,`descripcion`,`tipo`,`fecha_inicio`,`fecha_fin`,`recurrence_rule`,`seccion_id`,`parent_id`,`assigned_user_id`,`created_at`,`updated_at`)
VALUES
-- Ayer
(100,'Llamar al dentista','Pedir cita','puntual',
  TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 1 DAY), '10:00:00'),
  NULL,NULL,2,NULL,1,NOW(),NOW()),

-- Hoy
(101,'Enviar email a tutor','Dudas sobre el módulo','puntual',
  TIMESTAMP(CURDATE(), '16:00:00'),
  TIMESTAMP(CURDATE(), '16:15:00'),
  NULL,2,NULL,2,NOW(),NOW()),

-- Mañana
(102,'Comprar material','Cartulina y rotuladores','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '18:00:00'),
  NULL,NULL,1,NULL,NULL,NOW(),NOW()),

-- Pasado (hoy +2)
(103,'Reunión breve','Repasar plan','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '12:00:00'),
  NULL,NULL,1,NULL,3,NOW(),NOW()),

-- Futuro (+30)
(104,'Organizar armario','Cambio de temporada','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 30 DAY), '11:00:00'),
  NULL,NULL,1,NULL,1,NOW(),NOW());

-- =========================
-- TAREAS CON SUBTAREAS
-- 2 tareas padre + 3+ subtareas (>=3)
-- =========================
INSERT INTO `tarea`
(`id`,`titulo`,`descripcion`,`tipo`,`fecha_inicio`,`fecha_fin`,`recurrence_rule`,`seccion_id`,`parent_id`,`assigned_user_id`,`created_at`,`updated_at`)
VALUES
-- Padre 1 (hoy)
(110,'Preparar presentación','Presentación final del proyecto','puntual',
  TIMESTAMP(CURDATE(), '17:00:00'),
  TIMESTAMP(CURDATE(), '19:00:00'),
  NULL,2,NULL,2,NOW(),NOW()),

-- Subtareas del 110 (hoy/mañana/pasado)
(111,'Diapositivas: índice','Definir estructura','puntual',
  TIMESTAMP(CURDATE(), '17:10:00'),
  NULL,NULL,2,110,2,NOW(),NOW()),
(112,'Diapositivas: demo','Preparar flujo de demo','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '12:00:00'),
  NULL,NULL,2,110,2,NOW(),NOW()),
(113,'Diapositivas: conclusiones','Resumen final','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '10:00:00'),
  NULL,NULL,2,110,2,NOW(),NOW()),

-- Padre 2 (futuro +7)
(120,'Limpieza cocina','Limpieza a fondo','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '10:00:00'),
  NULL,NULL,1,NULL,1,NOW(),NOW()),

-- Subtareas del 120
(121,'Limpieza: nevera','Tirar caducados','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '10:30:00'),
  NULL,NULL,1,120,1,NOW(),NOW()),
(122,'Limpieza: horno','Desengrasar','puntual',
  TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 8 DAY), '10:30:00'),
  NULL,NULL,1,120,NULL,NOW(),NOW());

-- =========================
-- HÁBITOS (3)
-- =========================
INSERT INTO `tarea`
(`id`,`titulo`,`descripcion`,`tipo`,`fecha_inicio`,`fecha_fin`,`recurrence_rule`,`seccion_id`,`parent_id`,`assigned_user_id`,`created_at`,`updated_at`)
VALUES
(200,'Beber agua','8 vasos','habito',NULL,NULL,'daily',1,NULL,1,NOW(),NOW()),
(201,'Leer 20 min','Lectura diaria','habito',NULL,NULL,'daily',1,NULL,2,NOW(),NOW()),
(202,'Ejercicio','Rutina','habito',NULL,NULL,'weekly:1,3,5',1,NULL,NULL,NOW(),NOW());

-- =========================
-- COMPLETADOS (tarea_log)
-- - puntuales: algunas completadas
-- - subtareas: algunas completadas
-- - hábitos: ayer/hoy para rachas + ejemplo mañana (si NO quieres futuro, bórralo)
-- =========================
INSERT INTO `tarea_log`
(`id`,`tarea_id`,`fecha`,`completada`,`completed_at`,`completed_by_user_id`)
VALUES
-- Puntuales completadas
(1,100,DATE_SUB(CURDATE(), INTERVAL 1 DAY),true,DATE_SUB(NOW(), INTERVAL 1 DAY),1),
(2,101,CURDATE(),true,NOW(),2),

-- Subtareas completadas
(3,111,CURDATE(),true,NOW(),2),

-- Hábitos (racha: ayer + hoy)
(4,200,DATE_SUB(CURDATE(), INTERVAL 1 DAY),true,DATE_SUB(NOW(), INTERVAL 1 DAY),1),
(5,200,CURDATE(),true,NOW(),1),

-- Otro hábito completado hoy
(6,201,CURDATE(),true,NOW(),2),

-- (Opcional) ejemplo de “mañana” para ver cómo se vería en calendario:
(7,201,DATE_ADD(CURDATE(), INTERVAL 1 DAY),true,DATE_ADD(NOW(), INTERVAL 1 DAY),2);

COMMIT;