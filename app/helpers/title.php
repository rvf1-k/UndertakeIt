<?php

function getTitle(string $page): String
{
    switch ($page) {

        case 'register':
            $title = 'Resgistrarse';
            break;

        case 'login':
            $title = 'Login';
            break;
            
        case 'group':
        case 'edit-group':
        case 'edit-section':
            $groupId = getPathId();
            if (GroupController::watchGroup($groupId)) {
                $title = GroupController::GroupTitle($groupId);
            } else {
                $title = "Este grupo es privado 🔒";
            }
            break;

        case 'calendario':
            $title = 'Calendario';
            break;

        case 'habitos':
            $title = 'Habitos';
            break;

        case 'my-tasks':
            $title = 'Mis tareas';
            break;

        case 'next-7-days':
            $title = 'Proximos 7 días';
            break;

        case 'today':
            $title = 'Hoy';
            break;

        default:
            $title = 'today';
    }

    return $title;
}

function getPathId(): int
{
    return isset($_GET['id'])
        ? (int) $_GET['id']
        : null;
}

function getSectionId(): int
{
    return isset($_GET['id-section'])
        ? (int) $_GET['id-section']
        : null;
}
