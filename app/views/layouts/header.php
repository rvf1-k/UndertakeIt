<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($title) ?> - Undertakeit</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox/fancybox.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">



</head>

<style>
    :root {
        --primary-color: <?= isset($_COOKIE['primary_color']) ? $_COOKIE['primary_color'] : '#3b82f6' ?>;
    }
</style>

<body>
    <div id="app-layout" class="flex h-screen pb-16 md:pb-0">

        <?php include_once __DIR__ . '/../components/global-aside.php'; ?>

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col min-h-0 overflow-hidden">

            <!-- HEADER -->
            <header id="global-header" class="shrink-0 flex items-center justify-between px-4 py-4 md:px-8 md:py-5 bg-white border-b border-gray-200">

                <div class="flex items-center gap-4">
                    <button id="open-navbar-aside" class="block md:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-bars text-gray-700"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">
                        <?= htmlspecialchars($title) ?>
                    </h1>
                </div>

            </header>