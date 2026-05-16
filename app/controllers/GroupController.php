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

    public static function GroupList()
    {
        $groups = GrupoUsuario::findGroupsByUser();

        echo '<ul>';

        foreach ($groups as $group) {

            echo '<li>';
            echo '<form action="?page=group&id=' . $group['grupo_id'] . '" method="POST">';
            echo '<button type="submit">';
            echo $group['titulo'];
            echo '</button>';
            echo '<input type="hidden" name="action" value="view-group">';
            echo '</form>';
            echo '</li>';
        }

        echo '</ul>';
    }

    public static function GroupTitle(int $id)
    {
        $group = Grupo::findGroupsTitle($id);
        return $group['titulo'];
    }
}
