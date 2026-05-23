<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    public static function existUser(string $user_email) {
        return User::existUser($user_email);
    }
    public static function getIdUser(string $user_email) {
        return User::getIdUser($user_email);
    }
}