<?php

require_once __DIR__ . '/../../config/database.php';

class Grupo
{
    public static function create(string $titulo, string $descripcion)
    {
        $conexion = conexion();

        $sql = "
            INSERT INTO grupo (
                titulo,
                descripcion
            )
            VALUES (
                :titulo,
                :descripcion
            )
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion
        ]);

        return $conexion->lastInsertId();
    }

    public static function createDefault()
    {
        $conexion = conexion();

        $sql = "
            INSERT INTO grupo (
                titulo,
                is_default
            )
            VALUES (
                'Default',
                1
            )
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute();

        return $conexion->lastInsertId();
    }

    public static function getDefaultGroupId(int $userId)
    {
        $conexion = conexion();

        $sql = "SELECT seccion.id
        FROM seccion
        INNER JOIN grupo 
            ON grupo.id = seccion.grupo_id
        INNER JOIN grupo_usuario 
            ON grupo_usuario.grupo_id = grupo.id
        WHERE grupo_usuario.user_id = :currentUserId
        AND grupo.is_default = true
        LIMIT 1;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentUserId' => $userId
        ]);

        return $stmt->fetchColumn();
    }

    public static function getGroups(int $id)
    {
        $conexion = conexion();

        $sql = "SELECT * FROM `grupo` WHERE id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $id
        ]);

        return $stmt->fetch();
    }

    public static function delete(int $id)
    {
        $conexion = conexion();

        $sql = "DELETE FROM grupo WHERE grupo.id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $id
        ]);
    }

    public static function edit(int $id, string $titulo, string $descripcion)
    {
        $conexion = conexion();

        $sql = "UPDATE grupo SET titulo = :titulo, descripcion = :descripcion WHERE grupo.id = :currentGroupId";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':currentGroupId' => $id
        ]);
    }
}
