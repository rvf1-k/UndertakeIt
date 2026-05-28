<?php

require_once __DIR__ . '/../../config/database.php';

class Task
{
    public static function create(
        string $titulo,
        ?string $descripcion,
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
            fecha_inicio,
            fecha_fin,
            recurrence_rule,
            seccion_id,
            assigned_user_id
        )
        VALUES (
            :titulo,
            :descripcion,
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
            ':fecha_inicio' => $fechaInicio,
            ':fecha_fin' => $fechaFin,
            ':recurrence_rule' => $recurrenceRule,
            ':seccion_id' => $section,
            ':assigned_user_id' => $assignedUserId
        ]);

        return $conexion->lastInsertId();
    }

    public static function getTask(int $userId)
    {
        $conexion = conexion();

        $sql = "SELECT * FROM tarea WHERE assigned_user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public static function getTaskGroup(int $userId)
    {
        $conexion = conexion();

        $sql = "SELECT * FROM tarea WHERE assigned_user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public static function getToDoTasks(int $userId)
    {
        $conexion = conexion();

        $sql = "
        SELECT * 
        FROM tarea 
        WHERE assigned_user_id = :currentUserId
        AND fecha_inicio >= NOW()
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
    public static function getExpiredTasks(int $userId)
    {
        $conexion = conexion();

        $sql = "
        SELECT * 
        FROM tarea 
        WHERE assigned_user_id = :currentUserId
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

        $sql = "
        SELECT * 
        FROM tarea 
        WHERE assigned_user_id = :currentUserId
        AND DATE(fecha_inicio) = CURDATE()
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

        $sql = "
        SELECT * 
        FROM tarea 
        WHERE assigned_user_id = :currentUserId
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

        $sql = "
        SELECT * 
        FROM tarea 
        WHERE assigned_user_id = :currentUserId
        AND fecha_inicio BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
        ORDER BY fecha_inicio ASC;
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchAll();
    }
}
