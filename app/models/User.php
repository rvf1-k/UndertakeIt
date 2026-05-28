<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    public static function create(
        string $username,
        string $email,
        string $password
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

        $created = $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password_hash' => $passwordHash
        ]);

        if (!$created) {
            return false;
        }

        return $conexion->lastInsertId();
    }

    public static function findByEmail(string $email)
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
