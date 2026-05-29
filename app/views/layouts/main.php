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
            include_once __DIR__ . '/../components/download-pdf.php';
            $view = 'task/today.php';
            break;

        case 'next-7-days':
            include_once __DIR__ . '/../components/download-pdf.php';
            $view = 'task/next-7-days.php';
            break;

        case 'my-tasks':
            include_once __DIR__ . '/../components/download-pdf.php';
            $view = 'task/my-tasks.php';
            break;

        case 'group':
            $view = 'group/grupos.php';
            break;

        case 'edit-group':
            $view = 'group/edit-grupo.php';
            break;

        case 'edit-section':
            $view = 'group/edit-section.php';
            break;

        case 'calendario':
            $view = 'task/calendar.php';
            break;

        case 'habitos':
            $view = 'task/list.php';
            break;

        default:
            include_once __DIR__ . '/../components/download-pdf.php';
            $view = 'task/today.php';
            break;
    }


    ?>
    <div class="flex h-screen bg-gray-100 min-h-0 overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0">
            <?php include_once __DIR__ . '/../components/navbar.php'; ?>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-auto">

            <?php include_once __DIR__ . '/../pages/' . $view; ?>

        </main>

        <?php include_once __DIR__ . '/../components/groups/add-groups.php'; ?>
    </div>