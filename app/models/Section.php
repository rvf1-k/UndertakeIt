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

        $sql = "SELECT id, titulo, descripcion  FROM seccion WHERE grupo_id = :currentGroupId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentGroupId' => $groupId
        ]);

        return $stmt->fetchAll();
    }

    public static function findSectionsIdGroups(int $sectionId)
    {
        $conexion = conexion();

        $sql = "SELECT grupo_id FROM seccion WHERE id = :currentSectionId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentSectionId' => $sectionId
        ]);

        return $stmt->fetchColumn();
    }

    public static function delete(int $id)
    {
        $conexion = conexion();

        $sql = "DELETE FROM seccion WHERE seccion.id = :currentSectionId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentSectionId' => $id
        ]);
    }

    public static function getSections(int $id)
    {
        $conexion = conexion();

        $sql = "SELECT * FROM seccion WHERE id = :currentSectionId;";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':currentSectionId' => $id
        ]);

        return $stmt->fetch();
    }

    public static function isInGroup(int $sectionId, int $groupId)
    {
        $conexion = conexion();

        $sql = "SELECT 1 FROM seccion WHERE grupo_id = :GroupId and id = :currentSectionId LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':GroupId' => $groupId,
            ':currentSectionId' => $sectionId
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public static function edit(int $id, string $titulo, string $descripcion)
    {
        $conexion = conexion();

        $sql = "UPDATE seccion SET titulo = :titulo, descripcion = :descripcion WHERE seccion.id = :currentSeccionId";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':currentSeccionId' => $id
        ]);
    }
}
