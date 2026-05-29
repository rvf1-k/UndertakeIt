<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    public static function existUserEmail(string $user_email) {
        return User::existUserEmail($user_email);
    }
    public static function getIdUser(string $user_email) {
        return User::getIdUser($user_email);
    }
}