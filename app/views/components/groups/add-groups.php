<div
    id="task-modal-group"
    class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-4">

    <div
        id="card"
        class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

            <h1 class="text-2xl font-semibold text-gray-800">
                Crear grupo
            </h1>

            <p class="text-sm text-gray-600 mt-1">
                Comparte tareas y organiza proyectos con otros usuarios.
            </p>

        </div>

        <!-- FORM -->
        <form method="POST" class="flex flex-col">

            <div class="p-6 flex flex-col gap-6">

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

            </div>

            <!-- BOTONES -->
            <div class="flex items-center justify-end gap-3 px-6 py-5 border-t border-gray-200 bg-white">

                <button
                    type="button"
                    id="close-modal-group"
                    class="btn btn-secondary">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Crear grupo

                </button>

            </div>

            <input type="hidden" name="action" value="add-group">

        </form>

    </div>

</div>