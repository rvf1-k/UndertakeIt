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
            $section,
            $assignedUserId
        );

        if (!$lastId) {
            echo "Error creando la tarea";
            return;
        }
        

        echo redirect();
        exit();
    }

    public static function formatDate($date)
    {
        $dateTime = new DateTime($date);
        $now = new DateTime();

        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        if ($dateTime->format('Y-m-d') === $now->format('Y-m-d')) {
            return $dateTime->format('H:i');
        }

        $day = $dateTime->format('d');
        $month = $months[(int)$dateTime->format('n')];

        if ($dateTime->format('Y') !== $now->format('Y')) {
            return "{$day}, {$month} {$dateTime->format('Y')}";
        }

        return "{$day}, {$month}";
    }

    public static function getTasks()
    {
        $userId = currentUserId();

        return Task::getTask($userId);
    }

    public static function getToDoTasks()
    {
        $userId = currentUserId();

        return Task::getToDoTasks($userId);
    }

    public static function getExpiredTasks()
    {
        $userId = currentUserId();

        return Task::getExpiredTasks($userId);
    }

    public static function getTodayToDoTasks()
    {
        $userId = currentUserId();

        return Task::getTodayToDoTasks($userId);
    }
    public static function getNext7ToDoTasks()
    {
        $userId = currentUserId();

        return Task::getNext7ToDoTasks($userId);
    }


    public static function getTodayExpiredTasks()
    {
        $userId = currentUserId();

        return Task::getTodayExpiredTasks($userId);
    }
    public static function printTasks(array $tasks)
    {
        foreach ($tasks as $task): ?>
            <div class="flex items-center gap-2 px-2 relative">
                <input type="checkbox" />
                <span><?= $task['titulo'] ?></span>
                <span class="ml-auto"><?= TaskController::formatDate($task['fecha_inicio']); ?></span>
                <form method="POST">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit" name="action" value="delete-task">
                        <i class="fa-solid fa-trash" style="font-size:15px;"></i>
                    </button>
                </form>
            </div>
        <?php endforeach;
    }

    public static function printExpiredTasks(array $tasks)
    {
        foreach ($tasks as $task): ?>
            <div class="flex items-center gap-2 px-2 relative">
                <input type="checkbox" />
                <span><?= $task['titulo'] ?></span>
                <span class="ml-auto text-red-500"><?= TaskController::formatDate($task['fecha_inicio']); ?></span>
                <form method="POST">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit" name="action" value="delete-task">
                        <i class="fa-solid fa-trash" style="font-size:15px;"></i>
                    </button>
                </form>
            </div>
<?php endforeach;
    }

    public static function getGroupTasks(int $taskId)
    {
        $groupId = Task::getGroupTasks($taskId);

        return $groupId;
    }
}
