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

            header("Location: ?page=login");
            exit;
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
        }

        $passwordCorrecta = password_verify(
            $password,
            $user['password_hash']
        );

        if (!$passwordCorrecta) {

            //die("Password incorrecta");
            echo "Password incorrecta";
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ?page=home");
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
                time() - 9999,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: ?page=home");
        exit();
    }
}
