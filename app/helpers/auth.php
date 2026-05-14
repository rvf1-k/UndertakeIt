<?php

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin($page)
{
    if (!isLoggedIn()) {

        if ($page !== 'register') {

            $page = 'login';
        }
    } else {

        $page = $page ?? 'home';
    }
}

function currentUserId()
{
    return $_SESSION['user_id'] ?? null;
}
