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
