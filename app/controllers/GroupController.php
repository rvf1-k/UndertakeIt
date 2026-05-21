<?php

require_once __DIR__ . '/../models/Group.php';
require_once __DIR__ . '/../models/GrupoUsuario.php';
require_once __DIR__ . '/../models/Section.php';

class GroupController
{
    public static function createGroup()
    {
        if (
            empty($_POST['titulo'])
        ) {
            echo "Añade un titulo";
            return;
        }

        $titulo = trim($_POST['titulo']);
        $descripcion = trim($_POST['descripcion']) ?? null;

        $lastId = Grupo::create(
            $titulo,
            $descripcion
        );

        Section::createFirst($lastId);

        //TODO: debug        
        if (!$lastId) {
            echo "Error creando el grupo";
        } else {
            $userId = currentUserId();

            $groupCreated = GrupoUsuario::addUser(
                $userId,
                $lastId
            );

            if (!$groupCreated) {
                echo "Error haciendo la relación";
            }
        }
    }

    public static function deleteGroup()
    {
        if (
            empty($_POST['group_id'])
        ) {
            echo "No hay un id de un grupo";
            return;
        }

        $group_id = trim($_POST['group_id']);

        //TODO: Comprobar que existe el grupo
        Grupo::delete(
            $group_id
        );
    }

    public static function GroupList()
    {
        $groups = GrupoUsuario::findGroupsByUser();

        echo '<ul>';

        foreach ($groups as $group) {
            echo "
<li class='menu-container relative'>

    <form action='?page=group&id={$group['grupo_id']}' method='POST'>

        <div class='flex items-center justify-between'>

            <button
                type='submit'
                class='flex-1 text-left'
            >
                " . htmlspecialchars($group['titulo']) . "
            </button>

            <div class='relative'>

                <button
                    type='button'
                    class='menu-toggle flex items-center justify-center border border-gray-300 hover:bg-gray-200 transition text-gray-600 px-3 py-2'
                >
                    <i class='fa-solid fa-ellipsis'></i>
                </button>

                <div class='menu-popup hidden absolute left-10 top-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 min-w-[150px]'>

                    <form method='POST'>

                        <input
                            type='hidden'
                            name='group_id'
                            value='{$group['grupo_id']}'
                        >

                        <button
                            type='button'
                            class='edit-group-btn w-full text-left px-4 py-2 hover:bg-gray-100'
                            data-id='{$group['grupo_id']}'
                            data-title='" . htmlspecialchars($group['titulo'], ENT_QUOTES) . "'
                        >
                            Editar
                        </button>

                    </form>

                    <form method='POST'>

                        <input
                            type='hidden'
                            name='group_id'
                            value='{$group['grupo_id']}'
                        >

                        <button
                            type='submit'
                            name='action'
                            value='delete-group'
                            class='w-full text-left px-4 py-2 text-red-600 hover:bg-red-50'
                        >
                            Borrar
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <input
            type='hidden'
            name='action'
            value='view-group'
        >

    </form>

</li>
";
        }

        echo '</ul>';
        echo "

<div
    id='edit-group-modal'
    class='hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50'
>

    <div class='bg-white rounded-xl p-6 w-full max-w-md'>

        <h2 class='text-xl font-semibold mb-4'>
            Editar grupo
        </h2>

        <form method='POST'>

            <input
                type='hidden'
                name='group_id'
                id='edit-group-id'
            >

            <input
                type='text'
                name='title'
                id='edit-group-title'
                class='w-full border border-gray-300 rounded-lg px-4 py-2 mb-4'
            >

            <div class='flex justify-end gap-2'>

                <button
                    type='button'
                    id='close-edit-modal'
                    class='px-4 py-2 border rounded-lg'
                >
                    Cancelar
                </button>

                <button
                    type='submit'
                    name='action'
                    value='edit-group'
                    class='px-4 py-2 bg-blue-600 text-white rounded-lg'
                >
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

";
    }

    public static function GroupTitle(int $id)
    {
        $group = Grupo::findGroupsTitle($id);
        return $group['titulo'];
    }
}
