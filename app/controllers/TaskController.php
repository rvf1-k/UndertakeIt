<?php

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/GrupoUsuario.php';
require_once __DIR__ . "/../../vendor/autoload.php";

use Dompdf\Dompdf;

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

        //TODO
        $fechaFin = !empty($_POST['fecha_fin'])
            ? $_POST['fecha_fin']
            : null;

        //TODO
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
        ) ? (
            ($_POST['assigned_user_id'] !== 'self') ?

            (int) $_POST['assigned_user_id'] : currentUserId()
        ) : null;


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

    public static function formatDate(string $date)
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
        return Task::getAllTasks($userId);
    }

    public static function getTask(int $taskId)
    {
        return Task::getTask($taskId);
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

    public static function getSectionExpiredTasks(int $sectionId)
    {
        $userId = currentUserId();

        return Task::getSectionExpiredTasks($userId, $sectionId);
    }

    public static function getSectionToDoTasks(int $sectionId)
    {
        $userId = currentUserId();

        return Task::getSectionToDoTasks($userId, $sectionId);
    }

public static function printTasks(array $tasks)
{   
    foreach ($tasks as $task): ?>

        <div
            class="task-item border border-gray-200 bg-white overflow-hidden transition hover:border-gray-300"
            data-task-id="<?= $task['id'] ?>">

            <!-- TASK HEADER -->
            <div
                class="task-toggle flex items-center gap-3 px-4 py-3 cursor-pointer select-none">

                <!-- CHECKBOX -->
                <input
                    type="checkbox"
                    <?php echo (TaskLogController::isCompleted($task['id'], $task['fecha_inicio']) ? "checked" : ""); ?>
                    class="task-checkbox"
                    data-task-id="<?= $task['id'] ?>" />

                <!-- TITULO -->
                <div class="flex flex-col min-w-0">

                    <a
                        href="?page=group&id=<?php echo SectionController::getGroup($task['seccion_id']) ?>"
                        class="text-sm font-medium text-gray-800 truncate">

                        <?= $task['titulo'] ?>

                    </a>

                </div>

                <!-- FECHA -->
                <span class="ml-auto text-xs text-gray-500 whitespace-nowrap">

                    <?= TaskController::formatDate($task['fecha_inicio']); ?>

                </span>

                <!-- TOGGLE -->
                <button
                    type="button"
                    class="task-expand w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-600 transition">

                    <i class="fa-solid fa-angle-down text-xs"></i>

                </button>

                <!-- DELETE -->
                <form method="POST">

                    <input
                        type="hidden"
                        name="task_id"
                        value="<?= $task['id'] ?>">

                    <button
                        type="submit"
                        name="action"
                        value="delete-task"
                        class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-red-500 transition">

                        <i class="fa-solid fa-trash text-xs"></i>

                    </button>

                </form>

            </div>

            <!-- TASK CONTENT -->
            <div
                class="task-content hidden border-t border-gray-200 bg-gray-50"
                data-task-content="<?= $task['id'] ?>">

                <div class="p-4 flex flex-col gap-4">

                    <!-- DESCRIPCIÓN -->
                    <?php if (!empty($task['descripcion'])): ?>

                        <p class="text-sm text-gray-600 leading-relaxed">

                            <?= $task['descripcion'] ?>

                        </p>

                    <?php endif; ?>

                    <!-- IMÁGENES -->
                    <div
                        class="task-images flex flex-wrap gap-3"
                        data-task-images="<?= $task['id'] ?>">

                        <?php
                        // TODO: Mostrar imágenes adjuntas
                        // foreach ($imagenes as $imagen):
                        ?>

                        <!--
                        <div class="task-image">
                            <img
                                src="<?= $imagen['ruta'] ?>"
                                alt="Imagen adjunta"
                                class="w-24 h-24 object-cover border border-gray-200">
                        </div>
                        -->

                        <?php // endforeach;
                        ?>

                    </div>

                    <!-- SUBTASKS -->
                    <div
                        class="task-subtasks flex flex-col gap-2"
                        data-task-subtasks="<?= $task['id'] ?>">

                        <?php
                        // TODO: Mostrar subtareas
                        ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach;
}

public static function printExpiredTasks(array $tasks)
{
    foreach ($tasks as $task): ?>

        <div
            class="task-item border border-red-200 bg-white overflow-hidden"
            data-task-id="<?= $task['id'] ?>">

            <!-- TASK HEADER -->
            <div
                class="task-toggle flex items-center gap-3 px-4 py-3 cursor-pointer select-none">

                <!-- CHECKBOX -->
                <input
                    type="checkbox"
                    class="task-checkbox"
                    data-task-id="<?= $task['id'] ?>" />

                <!-- TITULO -->
                <div class="flex flex-col min-w-0">

                    <a
                        href="?page=group&id=<?php echo SectionController::getGroup($task['seccion_id']) ?>"
                        class="text-sm font-medium text-gray-800 truncate">

                        <?= $task['titulo'] ?>

                    </a>

                </div>

                <!-- FECHA -->
                <span class="ml-auto text-xs text-red-500 whitespace-nowrap">

                    <?= TaskController::formatDate($task['fecha_inicio']); ?>

                </span>

                <!-- TOGGLE -->
                <button
                    type="button"
                    class="task-expand w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-600 transition">

                    <i class="fa-solid fa-angle-down text-xs"></i>

                </button>

                <!-- DELETE -->
                <form method="POST">

                    <input
                        type="hidden"
                        name="task_id"
                        value="<?= $task['id'] ?>">

                    <button
                        type="submit"
                        name="action"
                        value="delete-task"
                        class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-red-500 transition">

                        <i class="fa-solid fa-trash text-xs"></i>

                    </button>

                </form>

            </div>

            <!-- TASK CONTENT -->
            <div
                class="task-content hidden border-t border-red-100 bg-red-50/40"
                data-task-content="<?= $task['id'] ?>">

                <div class="p-4 flex flex-col gap-4">

                    <!-- DESCRIPCIÓN -->
                    <?php if (!empty($task['descripcion'])): ?>

                        <p class="text-sm text-gray-700 leading-relaxed">

                            <?= $task['descripcion'] ?>

                        </p>

                    <?php endif; ?>

                    <!-- IMÁGENES -->
                    <div
                        class="task-images flex flex-wrap gap-3"
                        data-task-images="<?= $task['id'] ?>">

                        <?php
                        // TODO: Mostrar imágenes adjuntas
                        // foreach ($imagenes as $imagen):
                        ?>

                        <!--
                        <div class="task-image">
                            <img
                                src="<?= $imagen['ruta'] ?>"
                                alt="Imagen adjunta"
                                class="w-24 h-24 object-cover border border-red-200">
                        </div>
                        -->

                        <?php // endforeach;
                        ?>

                    </div>

                    <!-- SUBTASKS -->
                    <div
                        class="task-subtasks flex flex-col gap-2"
                        data-task-subtasks="<?= $task['id'] ?>">

                        <?php
                        // TODO: Mostrar subtareas
                        ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach;
}
    public static function getGroupTasks(int $taskId)
    {
        $groupId = Task::getGroupTasks($taskId);

        return $groupId;
    }

    public static function deleteTask()
    {
        if (
            empty($_POST['task_id'])
        ) {
            echo "No hay un id de un grupo";
            return;
        }
        $taskId = trim($_POST['task_id']);
        $group_id = TaskController::getGroupTasks($taskId);

        if (GroupController::editorGroup($group_id)) {
            Task::delete(
                $taskId
            );
            echo redirect();
            exit();
        } else {
            echo "No tienes permiso para borrar las tareas";
            return;
        }
    }

    public static function downloadAllPdf()
    {
        $userId = currentUserId();

        $tasks = Task::getAllTasks($userId);
        $filtrer = $_GET['filtrer'] ?? "my-tasks";

        ob_start();
        ?>
        <html>

        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #222;
                    padding: 20px;
                    font-size: 14px;
                }

                section {
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 16px;
                    margin-bottom: 20px;
                }

                h2 {
                    margin: 0 0 15px 0;
                    font-size: 22px;
                }

                .flex {
                    display: flex;
                    align-items: center;
                }

                .justify-between {
                    justify-content: space-between;
                }

                .gap-2>* {
                    margin-right: 8px;
                }

                .task-checkbox {
                    margin-right: 10px;
                }

                .ml-auto {
                    margin-left: auto;
                    color: #666;
                    font-size: 12px;
                }

                a {
                    color: #111;
                    text-decoration: none;
                    font-weight: bold;
                }

                form {
                    display: none;
                }

                i {
                    display: none;
                }

                p {
                    margin: 5px 0 15px 28px;
                    color: #555;
                    font-size: 13px;
                }

                .relative {
                    padding: 8px 0;
                    border-bottom: 1px solid #eee;
                }
            </style>

        <body>

            <h1>UndertakeIt - <?= getTitle($filtrer) ?></h1>

            <?php require __DIR__ . "/../views/pages/task/" . $filtrer . ".php"; ?>

        </body>

        </html>

<?php
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream(getTitle($filtrer) . ".pdf");
    }
}
