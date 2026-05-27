<!-- Vencidas -->
<section class="border border-gray-400 rounded-[10px] m-4 p-4 md:mx-16 md:my-8">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Vencidas</h2>
        <i class="fa-solid fa-angle-down text-2xl text-gray-500"></i>
    </div>
    <div class="mt-4 flex flex-col gap-2">
        <?php
        $tasks = TaskController::getExpiredTasks();
        foreach ($tasks as $i => $task): ?>
            <div class="flex items-center gap-2 px-2 relative">
                <input type="checkbox" />
                <span><?= $task['titulo'] ?></span>
                <span class="ml-auto text-red-500"><?= TaskController::formatDate($task['fecha_inicio']); ?></span>
            </div>
        <?php endforeach;
        ?>
    </div>
</section>
<!-- Hábitos -->
<section class="border border-gray-400 rounded-[10px] m-4 p-4 md:mx-16 md:my-8">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Pendientes</h2>
        <i class="fa-solid fa-angle-down text-2xl text-gray-500"></i>
    </div>
    <div class="mt-4 flex flex-col gap-2">
        <?php
        $tasks = TaskController::getToDoTasks();
        foreach ($tasks as $i => $task): ?>
            <div class="flex items-center gap-2 px-2 relative">
                <input type="checkbox" />
                <span><?= $task['titulo'] ?></span>
                <span class="ml-auto"><?= TaskController::formatDate($task['fecha_inicio']); ?></span>
            </div>
        <?php endforeach;
        ?>
    </div>
</section>