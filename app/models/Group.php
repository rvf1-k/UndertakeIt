<?php

require_once __DIR__ . '/../../config/database.php';

class Grupo
{
    public static function create($titulo, $descripcion = null)
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
}