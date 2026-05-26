<?php

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/GrupoUsuario.php';

class TaskController
{
    public static function createTask()
    {
        if (
            empty($_POST['titulo']) ||
            empty($_POST['fecha_inicio'])
        ) {
            echo "Faltan campos obligatorios";
            return;
        }

        $titulo = trim($_POST['titulo']);

        $descripcion = !empty($_POST['descripcion'])
            ? trim($_POST['descripcion'])
            : null;

        $fechaInicio = $_POST['fecha_inicio'];

        $fechaFin = !empty($_POST['fecha_fin'])
            ? $_POST['fecha_fin']
            : null;

        $recurrenceRule = !empty($_POST['recurrence_rule'])
            ? $_POST['recurrence_rule']
            : null;

        $section = (
            isset($_POST['sectionSelect']) &&
            $_POST['sectionSelect'] !== 'none'
        )
            ? (int) $_POST['sectionSelect']
            : Grupo::getDefaultGroupId(currentUserId());

        $assignedUserId = (
            isset($_POST['assigned_user_id']) &&
            $_POST['assigned_user_id'] !== 'undefined'
        )
            ? (int) $_POST['assigned_user_id']
            : currentUserId();

        $lastId = Task::create(
            $titulo,
            $descripcion,
            $fechaInicio,
            $fechaFin,
            $recurrenceRule,
            $section['id'],
            $assignedUserId
        );

        //TODO: añadir tarea a usuarios

        if (!$lastId) {
            echo "Error creando la tarea";
            return;
        }

        echo "Tarea creada correctamente";
    }
}
