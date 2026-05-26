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
}
