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
            include_once __DIR__ . '/../pages/register.php';
            break;

        case 'login':
            include_once __DIR__ . '/../pages/login.php';
            break;

        case 'dashboard':
            include_once __DIR__ . '/../pages/dashboard.php';
            break;

        case 'calendario':
            include_once __DIR__ . '/../pages/task/calendar.php';
            break;

        case 'habitos':
            include_once __DIR__ . '/../pages/task/list.php';
            break;

        default:
            include_once __DIR__ . '/../pages/dashboard.php';
    }

    ?>

</main>