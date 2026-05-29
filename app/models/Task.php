<?php

require_once __DIR__ . '/../../config/database.php';

class Task
{
    public static function create(
        string $titulo,
        ?string $descripcion,
        ?string $imagen,
        string $fechaInicio,
        ?string $fechaFin,
        ?string $recurrenceRule,
        ?string $section,
        ?string $assignedUserId
    ) {
        $conexion = conexion();

        $sql = "
        INSERT INTO tarea (
            titulo,
            descripcion,
            imagen,
            fecha_inicio,
            fecha_fin,
            recurrence_rule,
            seccion_id,
            assigned_user_id
        )
        VALUES (
            :titulo,
            :descripcion,
            :imagen,
            :fecha_inicio,
            :fecha_fin,
            :recurrence_rule,
            :seccion_id,
            :assigned_user_id
        )
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':imagen' => $imagen,
            ':fecha_inicio' => $fechaInicio,
            ':fecha_fin' => $fechaFin,
            ':recurrence_rule' => $recurrenceRule,
            ':seccion_id' => $section,
            ':assigned_user_id' => $assignedUserId
        ]);

        return $conexion->lastInsertId();
    }

    public static function getAllTasks(int $userId)
    {
        $conexion = conexion();

        $sql = "SELECT tarea.* 
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        ORDER BY tarea.fecha_inicio ASC";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public static function getTask(int $taskId)
    {
        $conexion = conexion();

        $sql = "SELECT tarea.*  FROM tarea where tarea.id = :currenteTareaId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currenteTareaId' => $taskId
        ]);

        return $stmt->fetch();
    }

    public static function getToDoTasks(int $userId)
    {

        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND fecha_inicio >= NOW()
        ORDER BY tarea.fecha_inicio ASC";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
    public static function getExpiredTasks(int $userId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND fecha_inicio < NOW()
        ORDER BY fecha_inicio DESC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
    public static function getTodayToDoTasks(int $userId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND DATE(fecha_inicio) = CURDATE()
        AND fecha_inicio >= NOW()
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
    public static function getTodayExpiredTasks(int $userId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND DATE(fecha_inicio) = CURDATE()
        AND fecha_inicio < NOW()
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
    public static function getNext7ToDoTasks(int $userId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND fecha_inicio BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public static function getSectionToDoTasks(int $userId, int $sectionId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND seccion_id = :currentSectionId
        AND fecha_inicio >= NOW()
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId,
            ':currentSectionId' => $sectionId
        ]);

        return $stmt->fetchAll();
    }

    public static function getSectionExpiredTasks(int $userId, int $sectionId)
    {
        $conexion = conexion();

        $sql =
            "SELECT tarea.*  
        FROM tarea 
        INNER JOIN seccion ON tarea.seccion_id = seccion.id
        INNER JOIN grupo ON seccion.grupo_id = grupo.id
        INNER JOIN grupo_usuario ON grupo.id = grupo_usuario.grupo_id
        WHERE grupo_usuario.user_id = :currentUserId
        AND seccion_id = :currentSectionId
        AND fecha_inicio < NOW()
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId,
            ':currentSectionId' => $sectionId
        ]);

        return $stmt->fetchAll();
    }

    public static function getGroupTasks(int $taskId)
    {
        $conexion = conexion();

        $sql = "
        SELECT seccion.grupo_id 
        FROM tarea INNER 
        JOIN seccion ON tarea.seccion_id = seccion.id
        WHERE tarea.id = :taskId
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':taskId' => $taskId
        ]);

        return $stmt->fetchColumn();
    }

    public static function delete(int $id)
    {
        $conexion = conexion();

        $sql = "DELETE FROM tarea WHERE tarea.id = :tareaId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':tareaId' => $id
        ]);
    }
}
