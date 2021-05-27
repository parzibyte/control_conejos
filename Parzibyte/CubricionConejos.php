<?php

namespace Parzibyte;

class CubricionConejos
{
    static function iniciarCubricion($idConejo, $fecha)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("INSERT INTO cubricion_conejos(id_conejo, fecha_inicio) VALUES (?, ?)");
        return $sentencia->execute([$idConejo, $fecha]);
    }

    static function informacionGestacion($idConejo)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("SELECT id, id_conejo, fecha_inicio, fecha_fin, exitosa FROM cubricion_conejos WHERE id_conejo = ? AND fecha_fin IS NULL LIMIT 1;");
        $sentencia->execute([$idConejo]);
        $informacionCubricion = $sentencia->fetchObject();
        if (!$informacionCubricion) {
            return false;
        }
        return $informacionCubricion;
    }

    static function marcarFinGestacion($id, $fecha, $exitosa)
    {

        $bd = BD::obtener();
        $sentencia = $bd->prepare("UPDATE cubricion_conejos SET fecha_fin = ?, exitosa = ? WHERE id = ?");
        return $sentencia->execute([$fecha, $exitosa, $id]);
    }
}
