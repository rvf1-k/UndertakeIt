<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public static function register()
    {
        if (
            empty($_POST['username']) ||
            empty($_POST['password']) ||
            empty($_POST['email'])
        ) {
            echo "Faltan campos";
            return;
        }

        $usuario = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $created = User::create(
            $usuario,
            $email,
            $password
        );

        if ($created) {

            echo "Usuario registrado";

        } else {

            echo "Error";

        }
    }
}