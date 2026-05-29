<?php

require_once __DIR__ . '/../../config/database.php';

class GrupoUsuario
{
    public static function addUser(
        int $userId,
        int $grupoId,
        string $rol
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
                :rol
            )
        ";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':grupo_id' => $grupoId,
            ':rol' => $rol
        ]);
    }

    public static function findGroupsByUser()
    {
        $conexion = conexion();

        $sql = "SELECT grupo_id, grupo.titulo, grupo.is_default\n"

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

    public static function getUserRol(int $userId, int $groupId)
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

    public static function getUsers(int $groupId)
    {
        $conexion = conexion();

        $sql = "SELECT user_id, username, email, rol, baneado
            FROM grupo_usuario
            INNER JOIN users ON grupo_usuario.user_id = users.id
            WHERE grupo_id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId
        ]);

        return $stmt->fetchAll();
    }

    public static function editGroupUsers(
        int $groupId,
        int $userId,
        string $rol
    ) {
        $conexion = conexion();

        $sql = "UPDATE grupo_usuario SET rol = :rol WHERE user_id = :userId AND grupo_id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId,
            ':userId' => $userId,
            ':rol' => $rol
        ]);
    }

    public static function exit(
        int $groupId,
        int $userId
    ) {
        $conexion = conexion();

        $sql = "DELETE FROM grupo_usuario WHERE grupo_id = :currentGroupId and user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId,
            ':currentUserId' => $userId
        ]);
    }

    public static function ban(
        int $groupId,
        int $userId
    ) {
        $conexion = conexion();

        $sql = "UPDATE grupo_usuario 
            SET baneado = 1, 
                fecha_baneo = CURRENT_TIMESTAMP 
            WHERE grupo_id = :currentGroupId AND user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId,
            ':currentUserId' => $userId
        ]);
    }

    public static function unBan(
        int $groupId,
        int $userId
    ) {
        $conexion = conexion();

        $sql = "UPDATE grupo_usuario 
            SET baneado = 0, 
                fecha_baneo = CURRENT_TIMESTAMP 
            WHERE grupo_id = :currentGroupId AND user_id = :currentUserId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId,
            ':currentUserId' => $userId
        ]);
    }
}
