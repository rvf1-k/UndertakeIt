<div
    id="task-modal"
    class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-4">

    <div
        id="card"
        class="w-full max-w-2xl bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

            <h1 class="text-2xl font-semibold text-gray-800">
                Crear tarea
            </h1>

            <p class="text-sm text-gray-600 mt-1">
                Añade una nueva tarea y organiza tu flujo de trabajo.
            </p>

        </div>

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data" class="flex flex-col">

            <div class="p-6 flex flex-col gap-6">

                <!-- Título -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="titulo"
                        class="text-sm font-medium text-gray-700">

                        Título

                    </label>

                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        maxlength="255"
                        required
                        class="input">
                </div>

                <!-- Descripción -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="descripcion"
                        class="text-sm font-medium text-gray-700">

                        Descripción

                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        maxlength="255"
                        rows="4"
                        class="input resize-none"></textarea>

                </div>

                <?php
                //TODO: Implementar habitos
                /*
                <!-- Tipo -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="tipo"
                        class="text-sm font-medium text-gray-700">

                        Tipo

                    </label>
                    
                    <select
                        id="tipo"
                        name="tipo"
                        class="input"
                        required>
                    
                        <option value="puntual">
                            Puntual
                        </option>
                    
                        <option value="habito">
                            Hábito
                        </option>
                    
                    </select>

                </div>
                */
                ?>

                <!-- Fechas (con imagen) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="form-group flex flex-col gap-2">

                        <label
                            for="fecha_inicio"
                            class="text-sm font-medium text-gray-700">

                            Fecha inicio

                        </label>

                        <input
                            type="datetime-local"
                            id="fecha_inicio"
                            name="fecha_inicio"
                            class="input">

                    </div>
                    <div class="form-group flex flex-col gap-2">
                        <label
                            for="imagen"
                            class="text-sm font-medium text-gray-700">

                            Imagen

                        </label>

                        <input
                            type="file"
                            id="imagen"
                            name="imagen"
                            accept="image/*"
                            class="input cursor-pointer">
                    </div>

                    <?php
                    //TODO: fecha fin
                    /*
                    <div class="form-group flex flex-col gap-2">

                        <label
                            for="fecha_fin"
                            class="text-sm font-medium text-gray-700">

                            Fecha fin

                        </label>

                        <input
                            type="datetime-local"
                            id="fecha_fin"
                            name="fecha_fin"
                            class="input">

                    </div>
                    */
                    ?>

                </div>

                <?php
                //TODO: reglas de recurrencia
                /*
                <!-- Recurrencia -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="recurrence_rule"
                        class="text-sm font-medium text-gray-700">

                        Regla de recurrencia

                    </label>

                    <select
                        id="recurrence_rule"
                        name="recurrence_rule"
                        class="input">

                        <option value="">
                            Sin recurrencia
                        </option>

                        <option value="daily">
                            Diario
                        </option>

                        <option value="weekly">
                            Semanalmente
                        </option>

                        <option value="monthly">
                            Mensual
                        </option>

                        <option value="yearly">
                            Anualmente
                        </option>

                        <option value="weekdays">
                            Cada día laborable (Lun - Vie)
                        </option>

                        <option value="custom">
                            Personalizado - In work
                        </option>

                    </select>

                </div>
                */
                ?>

                <!-- Sección -->
                <div class="form-section flex flex-col gap-2">

                    <label
                        for="sectionSelect"
                        class="text-sm font-medium text-gray-700">

                        Grupo

                    </label>

                    <select
                        id="sectionSelect"
                        name="sectionSelect"
                        required
                        class="input">

                        <option selected value="none">
                            Sin agrupar
                        </option>

                        <?php
                        $sectionsByGroup = GroupController::getByGroupAllSections();

                        foreach ($sectionsByGroup as $i => $group): ?>

                            <?php if ($group['is_default']) {
                                continue;
                            } ?>

                            <option disabled>
                                <?= htmlspecialchars($group['titulo']) ?>
                            </option>

                            <?php
                            foreach ($group[0] as $t => $section): ?>

                                <option
                                    value="<?= $section['id'] ?>"
                                    data-group-id="<?= $group['grupo_id'] ?>">

                                    — <?= htmlspecialchars($section['titulo']) ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endforeach; ?>

                    </select>

                </div>

                <?php
                //TODO: Encadenar tareas
                /*
                <!-- Parent task -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="parent_id"
                        class="text-sm font-medium text-gray-700">

                        Tarea padre (opcional)

                    </label>
                    
                    <select
                        id="parent_id"
                        name="parent_id"
                        class="input">
                    
                        <option value="">
                            Ninguna
                        </option>
                    
                        <?php foreach ($tareas as $tarea): ?>

                            <option value="<?= $tarea['id'] ?>">
                                <?= htmlspecialchars($tarea['titulo']) ?>
                            </option>

                        <?php endforeach; ?>
                        
                    </select>

                </div>
                */
                ?>

                <!-- Usuario asignado -->
                <div class="form-group flex flex-col gap-2">

                    <label
                        for="userSelect"
                        class="text-sm font-medium text-gray-700">

                        Asignar usuario

                    </label>

                    <select
                        id="userSelect"
                        name="assigned_user_id"
                        class="input">

                        <option selected value="self">
                            Sin grupo asignado
                        </option>

                    </select>

                </div>

            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end gap-3 px-6 py-5 border-t border-gray-200 bg-white">

                <button
                    type="button"
                    id="close-modal-task"
                    class="btn btn-secondary">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Crear tarea

                </button>

            </div>

            <input type="hidden" name="action" value="add-task">

        </form>

    </div>

</div>