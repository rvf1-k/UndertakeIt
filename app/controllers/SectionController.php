<?php

require_once __DIR__ . '/../models/Section.php';

class SectionController
{
    public static function SectionList(int $groupId)
    {
        $sections = self::getSectionsInGroup($groupId);

?>
        <?php foreach ($sections as $section): ?>

            <div class="menu-container relative min-w-[340px] max-w-[340px] bg-white border border-gray-300 shadow-sm flex flex-col">

                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">

                    <h2 class="text-xl font-semibold text-gray-800 truncate pr-4">
                        <?= htmlspecialchars($section['titulo']) ?>
                    </h2>

                    <div class="relative">

                        <button
                            type="button"
                            class="menu-toggle w-10 h-10 flex items-center justify-center border border-gray-300 hover:bg-gray-200 transition text-gray-600">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        <div class="menu-popup hidden absolute right-0 top-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 min-w-[150px]">

                            <button
                                class="w-full text-left px-4 py-2 hover:bg-gray-50">

                                <a href="?page=edit-section&id=<?= $groupId ?>&id-section=<?= $section['id'] ?>">
                                    Editar
                                </a>
                            </button>

                            <form method="POST">

                                <input
                                    type="hidden"
                                    name="sectionId"
                                    value="<?= htmlspecialchars($section['id']) ?>">

                                <button
                                    type="submit"
                                    name="action"
                                    value="delete-section"
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Borrar
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                <div class="px-6 py-5 border-b border-gray-200">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        <?= htmlspecialchars($section['descripcion']) ?>
                    </p>
                </div>

                <div class="p-5 flex-1 bg-gray-50 min-h-[400px] scrollbar-hide overflow-auto task-list-section">

                    <div class="flex flex-col gap-4">

                        <?php
                        $expiredTasks = TaskController::getSectionExpiredTasks($section['id']);
                        TaskController::printExpiredTasks($expiredTasks);

                        $tasks = TaskController::getSectionToDoTasks($section['id']);
                        TaskController::printTasks($tasks);
                        ?>

                    </div>

                </div>

                <div class="p-5 border-t border-gray-200 bg-white">

                    <button
                        type="button"
                        id="add-task-section"
                        class="w-full py-3 px-4 border border-gray-300 bg-gray-100 hover:bg-gray-200 transition text-sm font-medium text-gray-700">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Añadir tarea
                    </button>

                </div>

            </div>

        <?php endforeach; ?>

        <div class="min-w-[340px] max-w-[340px]">

            <button
                id="crear-section"
                type="button"
                class="w-full h-[220px] border-2 border-dashed border-gray-400 hover:bg-gray-200 transition flex flex-col items-center justify-center gap-5 bg-white text-gray-600 p-6">
                <div class="w-14 h-14 border border-gray-300 flex items-center justify-center text-2xl bg-gray-100">
                    <i class="fa-solid fa-plus"></i>
                </div>

                <span class="font-medium text-xl">
                    Crear sección
                </span>
            </button>

        </div>
<?php
    }

    public static function createSection(int $groupId)
    {
        if (
            empty($_POST['titulo'])
        ) {
            echo "Añade un titulo";
            return;
        }

        $titulo = trim($_POST['titulo']);
        $descripcion = trim($_POST['descripcion']) ?? null;

        $lastId = Section::create(
            $groupId,
            $titulo,
            $descripcion
        );

        //TODO: Tarea::createFirst($lastId);

        //TODO: debug        
        if (!$lastId) {
            echo "Error creando el grupo";
            return;
        }

        echo redirect();
        exit();
    }

    public static function deleteSection()
    {
        if (
            empty($_POST['sectionId'])
        ) {
            echo "No hay un id de un grupo";
            return;
        }

        $sectionId = trim($_POST['sectionId']);

        $group_id = Section::findSectionsIdGroups($sectionId);

        if (GroupController::ownGroup($group_id)) {
            Section::delete(
                $sectionId
            );
            echo redirect();
            exit();
        } else {
            echo "No tienes permiso para borrar este grupo";
            return;
        }
    }

    public static function getSection(int $sectionId)
    {
        $section = Section::getSections($sectionId);
        return $section;
    }

    public static function isInGroup(int $sectionId, int $groupId)
    {
        return Section::isInGroup($sectionId, $groupId);
    }

    public static function editSection(int $sectionId, int $groupId)
    {
        if (!GroupController::adminGroup($groupId)) {
            echo "No tienes permiso para editar las secciones";
            return;
        }

        if (!SectionController::isInGroup($sectionId, $groupId)) {
            echo "No existe esta seccion";
            return;
        }

        if (
            empty($_POST['titulo'])
        ) {
            echo "Añade un titulo";
            return;
        }

        $titulo = trim($_POST['titulo']);
        $descripcion = trim($_POST['descripcion']) ?? null;

        Section::edit(
            $sectionId,
            $titulo,
            $descripcion
        );

        echo redirect();
        exit();
    }

    public static function getSectionsInGroup(int $groupId)
    {
        return Section::findSectionsByGroups($groupId);
    }

    public static function getGroup(int $sectionId)
    {
        return Section::getGroup($sectionId);
    }
}
