<?php

require_once __DIR__ . '/../models/Section.php';

class SectionController
{
public static function SectionList(int $groupId)
{
    $sections = Section::findSectionsByGroups($groupId);

    echo '<div class="flex gap-8 overflow-x-auto p-8 bg-gray-100 min-h-screen">';

    foreach ($sections as $section) {

        echo '
        <div class="min-w-[340px] max-w-[340px] bg-white border border-gray-300 shadow-sm flex flex-col">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-semibold text-gray-800 truncate pr-4">
                    ' . htmlspecialchars($section['titulo']) . '
                </h2>

                <button 
                    type="button"
                    class="w-10 h-10 flex items-center justify-center border border-gray-300 hover:bg-gray-200 transition text-gray-600"
                >
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
            </div>

            <div class="px-6 py-5 border-b border-gray-200">
                <p class="text-sm text-gray-600 leading-relaxed">
                    ' . htmlspecialchars($section['descripcion']) . '
                </p>
            </div>

            <div class="p-5 flex-1 bg-gray-50 min-h-[400px]">

                <!-- LISTA DE TAREAS -->

                <div class="flex flex-col gap-4">
                    <!-- Aquí van las tareas -->
                </div>

            </div>

            <div class="p-5 border-t border-gray-200 bg-white">
                <button 
                    type="button"
                    id="crear-tarea"
                    class="w-full py-3 px-4 border border-gray-300 bg-gray-100 hover:bg-gray-200 transition text-sm font-medium text-gray-700"
                >
                    <i class="fa-solid fa-plus mr-2"></i>
                    Añadir tarea
                </button>
            </div>

        </div>';
    }

    echo '
    <div class="min-w-[340px] max-w-[340px]">

        <button 
            id="crear-section"
            type="button"
            class="w-full h-[220px] border-2 border-dashed border-gray-400 hover:bg-gray-200 transition flex flex-col items-center justify-center gap-5 bg-white text-gray-600 p-6"
        >
            <div class="w-14 h-14 border border-gray-300 flex items-center justify-center text-2xl bg-gray-100">
                <i class="fa-solid fa-plus"></i>
            </div>

            <span class="font-medium text-xl">
                Crear sección
            </span>
        </button>

    </div>';

    echo '</div>';
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
        } else {
            //TODO: Añadir tarea?
        }
    }
}
