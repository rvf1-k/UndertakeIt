<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/GroupController.php';
require_once __DIR__ . '/../app/controllers/SectionController.php';
require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/helpers/title.php';

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
        case 'add-section':
            $groupId = getGroupId();
            SectionController::createSection($groupId);
            break;
    }
}

// Layout
include_once __DIR__ . '/../app/views/layouts/header.php';
include_once __DIR__ . '/../app/views/layouts/main.php';
include_once __DIR__ . '/../app/views/layouts/footer.php';
