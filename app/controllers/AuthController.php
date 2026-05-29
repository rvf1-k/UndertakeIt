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

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email no válido";
            return;
        }

        if (User::existUserName($username)) {
            echo "El usuario ya existe";
            return;
        }

        if (User::existUserEmail($email)) {
            echo "El email ya existe";
            return;
        }

        $userId = User::create(
            $username,
            $email,
            $password
        );

        if ($userId) {
            $groupDefault = Grupo::createDefault();
            Section::createFirst($groupDefault);
            GrupoUsuario::addUser(
                $userId,
                $groupDefault,
                'owner'
            );

            echo redirectOther("page=login");
            exit();
        } else {
            echo "Error";
        }
    }

    public static function login()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user = User::findByEmail($email);

        if (!$user) {

            //die("Usuario no encontrado");
            echo "Usuario no encontrado";
            return;
        }

        $passwordCorrecta = password_verify(
            $password,
            $user['password_hash']
        );

        if (!$passwordCorrecta) {

            //die("Password incorrecta");
            echo "Password incorrecta";
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo redirectHome();
        exit;
    }



    public static function logout()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                1,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        echo redirectHome();
        exit();
    }
}
