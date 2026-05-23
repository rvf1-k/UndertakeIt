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

    public static function findByEmail($email)
    {
        $conexion = conexion();

        $sql = "
        SELECT *
        FROM users
        WHERE email = :email
        LIMIT 1
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch();
    }

    public static function getIdUser(string $email)
    {
        $conexion = conexion();

        $sql = "
        SELECT id
        FROM users
        WHERE email = :email
        LIMIT 1
    ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetchColumn();
    }
    
    public static function existUser(string $email)
    {
        $conexion = conexion();

        $sql = "SELECT 1 FROM users WHERE email = :email LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return (bool) $stmt->fetchColumn();
    }
}
