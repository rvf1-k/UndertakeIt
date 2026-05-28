<div
    id="task-modal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div
        id="card"
        class="bg-white p-6 rounded-2xl w-full max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Crear tarea
        </h1>

        <form method="POST" class="flex flex-col gap-4">

            <!-- Título -->
            <div class="form-group flex flex-col">
                <label for="titulo">
                    Título
                </label>

                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    maxlength="255"
                    required
                    class="border rounded-lg p-2">
            </div>

            <!-- Descripción -->
            <div class="form-group flex flex-col">
                <label for="descripcion">
                    Descripción
                </label>

                <textarea
                    id="descripcion"
                    name="descripcion"
                    maxlength="255"
                    rows="4"
                    class="border rounded-lg p-2"></textarea>
            </div>

            <?php
            //TODO: Implementar habitos
            /*
            <!-- Tipo -->
            <div class="form-group flex flex-col">
                <label for="tipo">
                    Tipo
                </label>
                
                <select
                id="tipo"
                name="tipo"
                class="border rounded-lg p-2"
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

            <!-- Fechas -->
            <div class="grid grid-cols-2 gap-4">

                <div class="form-group flex flex-col">
                    <label for="fecha_inicio">
                        Fecha inicio
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_inicio"
                        name="fecha_inicio"
                        class="border rounded-lg p-2">
                </div>

                <div class="form-group flex flex-col">
                    <label for="fecha_fin">
                        Fecha fin
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_fin"
                        name="fecha_fin"
                        class="border rounded-lg p-2">
                </div>

            </div>

            <?php
            //TODO: reglas de recurrencia
            /*
            <!-- Recurrencia -->
            <div class="form-group flex flex-col">
                <label for="recurrence_rule">
                    Regla de recurrencia
                </label>

                <select
                    id="recurrence_rule"
                    name="recurrence_rule"
                    class="border rounded-lg p-2">

                    <option value="">Sin recurrencia</option>

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
            </div>*/
            ?>
            <!-- Sección -->
            <div class="form-section flex flex-col">
                <label for="sectionSelect">
                    Grupo
                </label>

                <select
                    id="sectionSelect"
                    name="sectionSelect"
                    required
                    class="border rounded-lg p-2">

                    <option selected value="none">
                        Sin agrupar
                    </option>

                    <?php
                    $sectionsByGroup = GroupController::getByGroupAllSections();
                    var_dump($sectionsByGroup);
                    foreach ($sectionsByGroup as $i => $group): ?>

                        <?php if ($group['is_default']) {
                            continue;
                        } ?>

                        <option disabled>
                            <?= htmlspecialchars($group['titulo']) ?>
                        </option>
                        <?php
                        foreach ($group[0] as $t => $section): ?>
                            <option value="<?= $section['id'] ?>"
                                data-group-id="<?= $group['grupo_id'] ?>">
                                — <?= htmlspecialchars($section['titulo']) ?>
                            </option>

                        <?php endforeach;
                        ?>
                    <?php endforeach;
                    ?>


                </select>
            </div>
            <?php
            //TODO: Encadenar tareas
            /*
            <!-- Parent task -->
            <div class="form-group flex flex-col">
                <label for="parent_id">
                    Tarea padre (opcional)
                </label>
                
                <select
                id="parent_id"
                name="parent_id"
                class="border rounded-lg p-2">
                
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
            <div class="form-group flex flex-col">
                <label for="userSelect">
                    Asignar usuario
                </label>

                <select
                    id="userSelect"
                    name="assigned_user_id"
                    class="border rounded-lg p-2">

                    <option selected value="self">
                        Sin grupo asignado
                    </option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex gap-2 justify-end mt-4">

                <button
                    type="button"
                    id="close-modal-task"
                    class="px-4 py-2 border rounded-lg">
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="bg-zinc-900 text-white px-4 py-2 rounded-lg">
                    Crear tarea
                </button>

            </div>

            <input type="hidden" name="action" value="add-task">

        </form>

    </div>

</div>