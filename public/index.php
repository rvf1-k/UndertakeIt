<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/GroupController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/SectionController.php';
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
            $groupId = getGroupId();
            GroupController::editGroup($groupId);
            break;

        case 'add-user':
            $groupId = getGroupId();
            GroupController::addUser($groupId);
            break;

        case 'edit-group-users':
            $groupId = getGroupId();
            GroupController::editGroupUsers($groupId);
            break;

        case 'add-section':
            $groupId = getGroupId();
            SectionController::createSection($groupId);
            break;

        case 'edit-section':
            $sectionId = getSectionId();
            $groupId = getGroupId();
            SectionController::editSection($sectionId, $groupId);
            break;

        case 'delete-section':
            SectionController::deleteSection();
            break;
    }
}

// Layout
include_once __DIR__ . '/../app/views/layouts/header.php';
include_once __DIR__ . '/../app/views/layouts/main.php';
include_once __DIR__ . '/../app/views/layouts/footer.php';
