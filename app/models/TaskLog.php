<?php

require_once __DIR__ . '/../../config/database.php';

class TaskLog
{
    public static function create(
        string $taskId,
        string $taskDate,
        int $userId
    ) {
        $conexion = conexion();

        $sql = "
            INSERT INTO tarea_log (
                tarea_id,
                fecha,
                completed_by_user_id
            )
            VALUES (
                :taskId,
                :taskDate,
                :userId
            )
        ";

        $stmt = $conexion->prepare($sql);

        $created = $stmt->execute([
            ':taskId' => $taskId,
            ':taskDate' => $taskDate,
            ':userId' => $userId
        ]);

        if (!$created) {
            return false;
        }
    }

    public static function getTasksLog(string $taskId)
    {
        $conexion = conexion();

        $sql = "
        SELECT tarea_log.*
        FROM tarea_log
        WHERE tarea_id = :taskId
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':taskId' => $taskId
        ]);

        return $stmt->fetchAll();
    }

    public static function check(
        string $taskId,
        string $taskDate,
        string $userId
    ) {
        $conexion = conexion();

        $sql = "UPDATE tarea_log
         SET completada = 1,
         completed_by_user_id = :userId
          
        WHERE tarea_log.tarea_id = :taskId
            and tarea_log.fecha = :taskDate";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':taskId' => $taskId,
            ':taskDate' => $taskDate,
            ':userId' => $userId
        ]);
    }

    public static function unCheck(
        string $taskId,
        string $taskDate,
        string $userId
    ) {
        $conexion = conexion();

        $sql = "UPDATE tarea_log
         SET completada = 0,
         completed_by_user_id = :userId
          
        WHERE tarea_log.tarea_id = :taskId
            and tarea_log.fecha = :taskDate";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':taskId' => $taskId,
            ':taskDate' => $taskDate,
            ':userId' => $userId
        ]);
    }

    public static function isCompleted(
        string $taskId,
        string $taskDate
    ) {
        $conexion = conexion();

        $sql = "SELECT 1 FROM tarea_log WHERE tarea_id = :taskId
        and tarea_log.fecha = :taskDate
         LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':taskId' => $taskId,
            ':taskDate' => $taskDate
        ]);

        return (bool) $stmt->fetchColumn();
    }
}
