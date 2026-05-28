<?php

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/GrupoUsuario.php';
require_once __DIR__ . '/../models/TaskLog.php';

class TaskLogController
{
    public static function checkTask(int $taskId)
    {
        $task = TaskController::getTask($taskId);

        if (!$task) {
            echo "No existe la tarea";
            return;
        }

        $userId = currentUserId();

        if (!GroupController::watchGroup($userId)) {
            echo "No tienes permiso para completar la tarea";
        }

        $taskDate = $task['fecha_inicio'];

        var_dump($taskDate);
        var_dump(self::isTasksLogByDate($taskId));

        if (self::isTasksLogByDate($taskId)) {
            TaskLog::check(
                $taskId,
                $taskDate,
                $userId
            );
        } else {
            TaskLog::create(
                $taskId,
                $taskDate,
                $userId
            );
        }
        return;
    }

    public static function getTasksLog(int $taskId)
    {
        return TaskLog::getTasksLog($taskId);
    }

    //TODO: Recursividad
    public static function isTasksLogByDate(int $taskId)
    {
        $taskLogs = self::getTasksLog($taskId);
        $task = TaskController::getTask($taskId);

        $fechas = array_column($taskLogs, 'fecha');
        return in_array($task['fecha_inicio'], $fechas);
    }

    //TODO: Recursividad
    public static function getTaskLogByDate(int $taskId, int $taskDate)
    {
        $taskLogs = self::getTasksLog($taskId);
        $fechas = array_column($taskLogs, 'fecha');
        return in_array($taskDate, $fechas);
    }

    public static function unCheckTask(int $taskId)
    {
        $task = TaskController::getTask($taskId);

        if (!$task) {
            echo "No existe la tarea";
            return;
        }

        $userId = currentUserId();

        if (!GroupController::watchGroup($userId)) {
            echo "No tienes permiso para completar la tarea";
        }

        $taskDate = $task['fecha_inicio'];
        TaskLog::unCheck(
            $taskId,
            $taskDate,
            $userId
        );

        return;
    }

    public static function isCompleted(string $taskId, string $taskDate)
    {
        return TaskLog::isCompleted($taskId, $taskDate);
    }
}
