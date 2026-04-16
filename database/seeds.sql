```sql
-- =========================
-- USERS (10 usuarios)
-- =========================
INSERT INTO users (id, username, email, password_hash, created_at) VALUES
(1, 'admin', 'admin@mail.com', 'hash', NOW()),
(2, 'ana', 'ana@mail.com', 'hash', NOW()),
(3, 'juan', 'juan@mail.com', 'hash', NOW()),
(4, 'maria', 'maria@mail.com', 'hash', NOW()),
(5, 'pedro', 'pedro@mail.com', 'hash', NOW()),
(6, 'lucas', 'lucas@mail.com', 'hash', NOW()),
(7, 'sofia', 'sofia@mail.com', 'hash', NOW()),
(8, 'diego', 'diego@mail.com', 'hash', NOW()),
(9, 'laura', 'laura@mail.com', 'hash', NOW()),
(10, 'carlos', 'carlos@mail.com', 'hash', NOW());

-- =========================
-- GRUPOS (3 proyectos)
-- =========================
INSERT INTO grupo (id, titulo, descripcion, created_at, updated_at) VALUES
(1, 'App Web', 'Desarrollo frontend/backend', NOW(), NOW()),
(2, 'Marketing', 'Campañas y contenido', NOW(), NOW()),
(3, 'Personal', 'Tareas personales', NOW(), NOW());

-- =========================
-- RELACIONES USUARIO-GRUPO
-- =========================
INSERT INTO grupo_usuario (user_id, grupo_id, rol, baneado, joined_at) VALUES
(1,1,'admin',false,NOW()),
(2,1,'editor',false,NOW()),
(3,1,'editor',false,NOW()),
(4,1,'lector',false,NOW()),
(5,1,'lector',true,NOW()),

(1,2,'admin',false,NOW()),
(6,2,'editor',false,NOW()),
(7,2,'editor',false,NOW()),
(8,2,'lector',false,NOW()),

(2,3,'admin',false,NOW()),
(9,3,'editor',false,NOW()),
(10,3,'lector',false,NOW());

-- =========================
-- SECCIONES (tipo kanban)
-- =========================
INSERT INTO seccion (id, titulo, descripcion, grupo_id, created_at, updated_at) VALUES
(1,'Backlog','Pendientes',1,NOW(),NOW()),
(2,'En progreso','Trabajando',1,NOW(),NOW()),
(3,'Completadas','Hechas',1,NOW(),NOW()),

(4,'Ideas','Marketing ideas',2,NOW(),NOW()),
(5,'En ejecución','Campañas activas',2,NOW(),NOW()),
(6,'Finalizadas','Terminadas',2,NOW(),NOW()),

(7,'Pendientes','Cosas por hacer',3,NOW(),NOW()),
(8,'Haciendo','En curso',3,NOW(),NOW()),
(9,'Hecho','Finalizado',3,NOW(),NOW());

-- =========================
-- TAREAS (muchas + subtareas)
-- =========================
INSERT INTO tarea (id, titulo, descripcion, completada, seccion_id, assigned_user_id, created_at, updated_at) VALUES
(1,'Login UI','Diseñar pantalla login',false,1,2,NOW(),NOW()),
(2,'API Auth','Backend autenticación',false,2,3,NOW(),NOW()),
(3,'Landing Page','Página principal',true,3,4,NOW(),NOW()),
(4,'Config DB','Configurar base de datos',true,3,1,NOW(),NOW()),

(5,'Campaña Instagram','Posts y reels',false,4,6,NOW(),NOW()),
(6,'Email marketing','Newsletter',false,5,7,NOW(),NOW()),
(7,'SEO blog','Optimización SEO',true,6,8,NOW(),NOW()),

(8,'Comprar comida','Supermercado',false,7,9,NOW(),NOW()),
(9,'Ir al gym','Entrenamiento',false,8,10,NOW(),NOW()),
(10,'Leer libro','Terminar novela',true,9,2,NOW(),NOW());

-- =========================
-- SUBTAREAS (parent_id)
-- =========================
INSERT INTO tarea (id, titulo, descripcion, completada, seccion_id, parent_id, assigned_user_id, created_at, updated_at) VALUES
(11,'Input email','Campo email',true,2,1,2,NOW(),NOW()),
(12,'Input password','Campo password',false,2,1,2,NOW(),NOW()),

(13,'JWT','Implementar tokens',true,2,2,3,NOW(),NOW()),
(14,'Refresh token','Sistema refresh',false,2,2,3,NOW(),NOW()),

(15,'Comprar frutas','Manzanas y plátanos',false,7,8,9,NOW(),NOW()),
(16,'Comprar carne','Pollo y ternera',false,7,8,9,NOW(),NOW());
```