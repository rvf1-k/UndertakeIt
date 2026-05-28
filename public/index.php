<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/GroupController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/SectionController.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';
require_once __DIR__ . '/../app/controllers/TaskLogController.php';
require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/helpers/title.php';
require_once __DIR__ . '/../app/helpers/url_helper.php';

session_start();

$page = $_GET['page'] ?? 'home';
$title = getTitle($page);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? null;

    switch ($action) {

        case 'register':
            AuthController::register();
            break;

        case 'login':
            AuthController::login();
            break;

        case 'logout':
            AuthController::logout();
            break;

        case 'add-group':
            GroupController::createGroup();
            break;

        case 'delete-group':
            GroupController::deleteGroup();
            break;

        case 'edit-group':
            $groupId = getPathId();
            GroupController::editGroup($groupId);
            break;

        case 'add-user':
            $groupId = getPathId();
            GroupController::addUser($groupId);
            break;

        case 'edit-group-users':
            $groupId = getPathId();
            GroupController::editGroupUsers($groupId);
            break;

        case 'add-section':
            $groupId = getPathId();
            SectionController::createSection($groupId);
            break;

        case 'edit-section':
            $sectionId = getSectionId();
            $groupId = getPathId();
            SectionController::editSection($sectionId, $groupId);
            break;

        case 'delete-section':
            SectionController::deleteSection();
            break;

        case 'add-task':
            TaskController::createTask();
            break;
        case 'delete-task':
            TaskController::deleteTask();
            break;
    }
}

// Layout
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//TODO: Poner bien las rutas de public
switch ($path) {
    case '/undertakeit/public/tasks/users-by-group':
        $groupId = getPathId();

        $users = GroupController::getUsers($groupId);

        header('Content-Type: application/json');

        echo json_encode($users);

        exit;

    case '/undertakeit/public/tasks/check':
        $taskId = getPathId();
        TaskLogController::checkTask($taskId);
        exit;
    case '/undertakeit/public/tasks/uncheck':
        $taskId = getPathId();
        TaskLogController::unCheckTask($taskId);
        exit;


    default:
        include_once __DIR__ . '/../app/views/layouts/header.php';
        include_once __DIR__ . '/../app/views/layouts/main.php';
        include_once __DIR__ . '/../app/views/layouts/footer.php';
        break;
}
