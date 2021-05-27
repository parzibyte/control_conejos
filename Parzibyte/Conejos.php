<?php

namespace Parzibyte;

class Conejos
{
    static function registrarConejo(string $descripcion, string $genero, string $fechaNacimiento): bool
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO conejos(descripcion, genero, fecha_nacimiento) VALUES (?,?,?)");
        return $sentencia->execute([$descripcion, $genero, $fechaNacimiento]);
    }

    static function obtener(): array
    {

        $bd = BD::obtener();
        $sentencia = $bd->query("SELECT id, descripcion, genero, fecha_nacimiento FROM conejos");
        return $sentencia->fetchAll();
    }

    static function uno($id)
    {

        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT id, descripcion, genero, fecha_nacimiento FROM conejos WHERE id = ?");
        $sentencia->execute([$id]);
        return $sentencia->fetchObject();
    }
}
