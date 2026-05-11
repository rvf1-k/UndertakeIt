<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    public static function create(
        $username,
        $email,
        $password
    ) {
        $conexion = conexion();

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "
            INSERT INTO users (
                username,
                email,
                password_hash
            )
            VALUES (
                :username,
                :email,
                :password_hash
            )
        ";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password_hash' => $passwordHash
        ]);
    }
}