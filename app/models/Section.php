<?php

require_once __DIR__ . '/../../config/database.php';

class Section
{
    public static function createFirst(int $groupId)
    {
        $conexion = conexion();

        $sql = "
            INSERT INTO seccion (
                grupo_id
            )
            VALUES (
                :groupId
            )
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':groupId' => $groupId
        ]);

        return $conexion->lastInsertId();
    }
    
    public static function create(int $groupId, string $titulo, string $descripcion)
    {
        $conexion = conexion();

        $sql = "
            INSERT INTO seccion (
                grupo_id,
                titulo,
                descripcion

            )
            VALUES (
                :groupId,
                :titulo,
                :descripcion
            )
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':groupId' => $groupId,
            ':titulo' => $titulo,
            ':descripcion' => $descripcion ?? null
        ]);

        return $conexion->lastInsertId();
    }

    public static function findSectionsByGroups(int $groupId)
    {
        $conexion = conexion();

        $sql = "SELECT titulo, descripcion  FROM seccion WHERE grupo_id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId
        ]);

        return $stmt->fetchAll();
    }
}
