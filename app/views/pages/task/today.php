<div class="min-h-screen bg-gray-100 p-6 md:p-8">

    <div class="max-w-5xl mx-auto flex flex-col gap-6">

        <section class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">

                <div class="flex items-center gap-3">

                    <div class="w-3 h-3 rounded-full bg-red-500"></div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        Vencidas
                    </h2>

                </div>

                <button
                    type="button"
                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100 transition">

                    <i class="fa-solid fa-angle-down"></i>

                </button>

            </div>

            <div class="p-5 bg-white">

                <div class="flex flex-col gap-4">

                    <?php
                    $tasks = TaskController::getTodayExpiredTasks();
                    TaskController::printExpiredTasks($tasks);
                    ?>

                </div>

            </div>

        </section>

        <section class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">

                <div class="flex items-center gap-3">

                    <div
                        class="w-3 h-3 rounded-full"
                        style="background-color: var(--primary-color);"></div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        Pendientes
                    </h2>

                </div>

                <button
                    type="button"
                    class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100 transition">

                    <i class="fa-solid fa-angle-down"></i>

                </button>

            </div>

            <div class="p-5 bg-white">

                <div class="flex flex-col gap-4">

                    <?php
                    $tasks = TaskController::getTodayToDoTasks();
                    TaskController::printTasks($tasks);
                    ?>

                </div>

            </div>

        </section>

    </div>

</div>