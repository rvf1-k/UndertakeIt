<div
    id="task-modal-group"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">

    <div
        id="card"
        class="bg-white p-2 rounded-2xl w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">
            Crear grupo
        </h1>

        <form method="POST" class="flex flex-col gap-4">

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

            <div class="flex gap-2 justify-end">

                <button
                    type="button"
                    id="close-modal-group"
                    class="px-4 py-2 border rounded-lg">
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="bg-zinc-900 text-white px-4 py-2 rounded-lg">
                    Crear grupo
                </button>

            </div>
            <input type="hidden" name="action" value="add-group">
</form>
    </div>
</div>