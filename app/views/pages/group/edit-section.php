<section class="min-h-screen bg-gray-100 p-6 md:p-8">

    <?php
    $groupId = getPathId();
    $sectionId = getSectionId();

    if (!GroupController::watchGroup($groupId) || !GroupController::adminGroup($groupId)) {
        header("Location: ?page=group&id={$groupId}");
    } else {
        $section = SectionController::getSection($sectionId);
    }
    ?>

    <div class="max-w-3xl mx-auto">

        <form
            action="?page=edit-section&id=<?= $groupId ?>&id-section=<?= $sectionId ?>"
            method="POST">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

                    <h2 class="text-2xl font-semibold text-gray-800">
                        Editar sección
                    </h2>

                    <p class="text-sm text-gray-600 mt-1">
                        Modifica la información y organización de esta sección.
                    </p>

                </div>

                <div class="p-6 flex flex-col gap-6">

                    <div class="flex flex-col gap-2">

                        <label class="text-sm font-medium text-gray-700">
                            Título
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            value="<?= htmlspecialchars($section['titulo']) ?>"
                            required
                            class="input">

                    </div>

                    <div class="flex flex-col gap-2">

                        <label class="text-sm font-medium text-gray-700">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            rows="5"
                            class="input resize-none"><?= htmlspecialchars($section['descripcion']) ?></textarea>

                    </div>

                </div>

                <div class="px-6 py-5 border-t border-gray-200 bg-white flex justify-end">

                    <button
                        type="submit"
                        name="action"
                        value="edit-section"
                        class="btn btn-primary">

                        Guardar cambios

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>