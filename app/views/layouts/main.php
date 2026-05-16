<main>

    <?php

    $page = $_GET['page'] ?? null;

    if (!isset($_SESSION['user_id'])) {

        if ($page !== 'register') {

            $page = 'login';
        }
    } else {

        $page = $page ?? 'home';
    }

    switch ($page) {

        case 'register':
            $view = 'register.php';
            break;

        case 'login':
            $view = 'login.php';
            break;

        case 'dashboard':
            $view = 'dashboard.php';
            break;
        
        case 'group':
            $view = 'grupos.php';
            break;

        case 'calendario':
            $view = 'task/calendar.php';
            break;

        case 'habitos':
            $view = 'task/list.php';
            break;

        default:
            $view = 'dashboard.php';
    }

    include_once __DIR__ . '/../pages/' . $view;
    ?>

</main>