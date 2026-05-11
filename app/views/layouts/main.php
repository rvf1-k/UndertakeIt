<main>

    <?php

    if (isset($_SESSION['user_id'])) {

        $page = $_GET['page'] ?? 'home';
    } else {
        $page = $_GET['page'] ?? 'login';
    }


    switch ($page) {

        case 'register':
            include_once __DIR__ . '/../pages/register.php';
            break;

        case 'login':
            include_once __DIR__ . '/../pages/login.php';
            break;

        case 'dashboard':
            include_once __DIR__ . '/../pages/dashboard.php';
            break;

        default:
            include_once __DIR__ . '/../pages/dashboard.php';
    }

    ?>

</main>