<div class="h-full flex flex-col p-4 bg-white border-r border-gray-200 min-h-0">

    <section class="flex flex-col gap-1 flex-shrink-0">

        <a href="?page=today"
           class="px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 transition">
            Hoy
        </a>

        <a href="?page=next-7-days"
           class="px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 transition">
            Próximos 7 días
        </a>

        <a href="?page=my-tasks"
           class="px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 transition">
            Mis tareas
        </a>

    </section>

    <div class="my-4 border-t border-gray-200 flex-shrink-0"></div>

    <button id="crear-group"
        class="w-full px-3 py-2 rounded-lg text-sm font-medium bg-gray-100 hover:bg-gray-200 transition flex-shrink-0">
        + Crear grupo
    </button>

    <div class="my-4 border-t border-gray-200 flex-shrink-0"></div>

    <section id="groups-section" class="flex-1 min-h-0 flex flex-col gap-1 overflow-y-auto [scrollbar-width:thin]">

        <?php GroupController::GroupList(); ?>

    </section>

</div>