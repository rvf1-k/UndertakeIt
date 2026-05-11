<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';


$page = $_GET['page'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($page) {

        case 'register':
            AuthController::register();
            break;

        case 'login':
            AuthController::login();
            break;

        case 'logout':
            AuthController::logout();
            break;
    }
}

// Layout
include_once __DIR__ . '/../app/views/layouts/header.php';
include_once __DIR__ . '/../app/views/layouts/main.php';
include_once __DIR__ . '/../app/views/layouts/footer.php';
