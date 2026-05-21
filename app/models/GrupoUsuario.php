<?php

require_once __DIR__ . '/../../config/database.php';

class GrupoUsuario
{
    public static function addUser(
        $userId,
        $grupoId
    ) {
        $conexion = conexion();

        $sql = "
            INSERT INTO grupo_usuario (
                user_id,
                grupo_id,
                rol
            )
            VALUES (
                :user_id,
                :grupo_id,
                'owner'
            )
        ";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':grupo_id' => $grupoId
        ]);
    }

    public static function findGroupsByUser()
    {
        $conexion = conexion();

        $sql = "SELECT grupo_id, grupo.titulo\n"

            . "FROM grupo_usuario\n"

            . "JOIN grupo\n"

            . "    ON grupo.id = grupo_usuario.grupo_id\n"

            . "WHERE grupo_usuario.user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => currentUserId()
        ]);

        return $stmt->fetchAll();
    }

    public static function findUserRol(int $userId, int $groupId)
    {
        $conexion = conexion();

        $sql = "SELECT rol FROM grupo_usuario WHERE user_id = :currentUserId AND grupo_id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId,
            ':currentGroupId' => $groupId
        ]);

        return $stmt->fetchColumn();
    }
}
