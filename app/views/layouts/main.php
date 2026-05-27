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

        case 'today':
            $view = 'today.php';
            break;

        case 'next-7-days':
            $view = 'next-7-days.php';
            break;

        case 'my-tasks':
            $view = 'my-tasks.php';
            break;

        case 'group':
            $view = 'grupos.php';
            break;

        case 'edit-group':
            $view = 'edit-grupo.php';
            break;

        case 'edit-section':
            $view = 'edit-section.php';
            break;

        case 'calendario':
            $view = 'task/calendar.php';
            break;

        case 'habitos':
            $view = 'task/list.php';
            break;

        default:
            $view = 'today.php';
    }

    include_once __DIR__ . '/../pages/' . $view;
    ?>

</main>