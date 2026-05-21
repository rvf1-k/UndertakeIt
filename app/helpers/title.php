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

        case 'dashboard':
            $title = 'Dashboard';
            break;

        case 'group':
            $groupId = getGroupId();
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

        default:
            $title = 'Dashboard';
    }

    return $title;
}

function getGroupId(): int
{
    return isset($_GET['id'])
        ? (int) $_GET['id']
        : null;
}
