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
            return;
        } else {
            $userId = currentUserId();

            $groupCreated = GrupoUsuario::addUser(
                $userId,
                $lastId,
                'owner'
            );

            if (!$groupCreated) {
                echo "Error haciendo la relación";
                return;
            }
        }

        echo redirect();
        exit();
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

        if (self::ownGroup($group_id)) {
            Grupo::delete(
                $group_id
            );
            echo redirect();
            exit();
        } else {
            echo "No tienes permiso para borrar este grupo";
            return;
        }
    }

    public static function GroupList()
    {
        $groups = GrupoUsuario::findGroupsByUser();
?>

        <ul class="flex flex-col gap-2">

            <?php foreach ($groups as $group): ?>

                <?php
                if ($group['is_default']) {
                    continue;
                }
                ?>
                <li class="menu-container relative">

                    <div class="flex items-center justify-between gap-2 border-b border-gray-200 bg-white hover:bg-gray-50 transition">

                        <!-- LINK -->
                        <a
                            class="flex-1 text-sm text-gray-800 font-medium truncate px-3 py-2"
                            href="?page=group&id=<?= $group['grupo_id'] ?>">

                            <?= htmlspecialchars($group['titulo']) ?>

                        </a>

                        <!-- MENU -->
                        <div class="relative ml-auto">

                            <button
                                type="button"
                                class="menu-toggle w-6 h-6 flex items-center justify-center text-gray-400 hover:text-gray-600 transition">

                                <i class="fa-solid fa-ellipsis text-xs"></i>

                            </button>

                            <div
                                class="menu-popup hidden absolute right-0 top-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 min-w-[150px]">
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-50">
                                    <a href="?page=edit-group&id=<?= $group['grupo_id'] ?>"> Editar </a>
                                </button>

                                <form method="POST">
                                    <input type="hidden" name="group_id" value="<?= $group['grupo_id'] ?>" />

                                    <button
                                        type="submit"
                                        name="action"
                                        value="delete-group"
                                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                        Borrar
                                    </button>
                                </form>
                            </div>


                        </div>

                    </div>

                </li>
            <?php endforeach; ?>

        </ul>

<?php
    }

    public static function GroupTitle(int $id)
    {
        $group = Grupo::getGroups($id);
        return $group['titulo'];
    }

    public static function userRol(int $groupId): String
    {
        $userId = currentUserId();

        return GrupoUsuario::getUserRol($userId, $groupId);
    }

    public static function watchGroup(int $groupId)
    {
        switch (self::userRol($groupId)) {
            case 'owner':
            case 'admin':
            case 'editor':
            case 'lector':
                return true;
            default:
                return false;
        }
    }

    public static function editorGroup(int $groupId)
    {
        switch (self::userRol($groupId)) {
            case 'owner':
            case 'admin':
            case 'editor':
                return true;
            case 'lector':
            default:
                return false;
        }
    }

    public static function adminGroup(int $groupId)
    {
        switch (self::userRol($groupId)) {
            case 'owner':
            case 'admin':
                return true;
            case 'editor':
            case 'lector':
            default:
                return false;
        }
    }

    public static function ownGroup(int $groupId)
    {
        switch (self::userRol($groupId)) {
            case 'owner':
                return true;
            case 'admin':
            case 'editor':
            case 'lector':
            default:
                return false;
        }
    }

    public static function getGroup(int $group_id)
    {
        $group = Grupo::getGroups($group_id);
        return $group;
    }

    public static function getUsers(int $group_id)
    {
        $users = GrupoUsuario::getUsers($group_id);
        return $users;
    }

    public static function editGroup(int $group_id)
    {
        if (!self::adminGroup($group_id)) {
            echo "No tienes permiso para editar los grupos";
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

        Grupo::edit(
            $group_id,
            $titulo,
            $descripcion
        );

        echo redirect();
        exit();
    }
    
    public static function exitGroup(int $group_id)
    {
        if (!self::watchGroup($group_id)) {
            echo "No estás en este grupo grupos";
            return;
        }

        $userId = currentUserId();

        echo $group_id;
        echo "<br>";
        echo $userId;
        GrupoUsuario::exit(
            $group_id,
            $userId
        );

        echo redirectHome();
        exit();
    }

    public static function addUser(int $group_id)
    {

        if (!self::adminGroup($group_id)) {
            echo "No tienes permiso para añadir usuarios a este grupo";
            return;
        }

        if (
            empty($_POST['new_user_email'])
            ||
            empty($_POST['new_user_role'])
        ) {
            echo "Faltan datos";
            return;
        }

        $email = trim($_POST['new_user_email']);
        $role = trim($_POST['new_user_role']) ?? "Lector";

        if (!UserController::existUserEmail($email)) {
            echo "Este usuario no existe";
            return;
        }

        $userId = UserController::getIdUser($email);

        GrupoUsuario::addUser(
            $userId,
            $group_id,
            $role
        );

        echo redirect();
        exit();
    }

    public static function editGroupUsers(int $group_id)
    {
        if (!self::adminGroup($group_id)) {
            echo "No tienes permiso para añadir usuarios a este grupo";
            return;
        }

        $roles = $_POST['roles'] ?? [];

        foreach ($roles as $userId => $nuevoRol) {

            $userId = (int)$userId;

            $rolesPermitidos = ['lector', 'editor', 'admin'];
            if (!in_array($nuevoRol, $rolesPermitidos)) {
                continue;
            }

            GrupoUsuario::editGroupUsers($group_id, $userId, $nuevoRol);

            echo redirect();
            exit();
        }
    }

    public static function getByGroupAllSections()
    {
        $groups = GrupoUsuario::findGroupsByUser();

        $groupsAndSections = [];

        foreach ($groups as $i => $group) {
            $sections = SectionController::getSectionsInGroup($group['grupo_id']);
            $groupsAndSections[] = $group;
            $groupsAndSections[$i][] = $sections;
        }

        return $groupsAndSections;
    }
}
