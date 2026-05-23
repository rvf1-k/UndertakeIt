<section class="flex gap-8 p-8 overflow-x-auto bg-gray-100 min-h-screen">
    <?php
    $groupId = getGroupId();
    $sectionId = getSectionId();
    if (!GroupController::watchGroup($groupId) || !GroupController::adminGroup($groupId)) {
        header("Location: ?page=group&id={$groupId}");
    } else {
        $section = SectionController::getSection($sectionId);
    }
    ?>
    <form action="?page=edit-section&id=<?= $groupId ?>&id-section=<?= $sectionId ?>" method="POST" class="group-form">
        <div class="card">
            <h2>Editar sección</h2>

            <label>
                Título
                <input
                    type="text"
                    name="titulo"
                    value="<?= htmlspecialchars($section['titulo']) ?>"
                    required>
            </label>

            <label>
                Descripción
                <textarea
                    name="descripcion"
                    rows="4"><?= htmlspecialchars($section['descripcion']) ?></textarea>
            </label>

            <button type="submit" name="action" value="edit-section">
                Guardar cambios
            </button>
        </div>
    </form>
</section>