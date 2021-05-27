<?php

namespace Parzibyte;

class Fechas
{
    const DIA_EN_SEGUNDOS = 86400;
    static function diasTranscurridosHastaHoy(string $fecha): int
    {
        $segundosHoy = time();
        $segundosFecha = strtotime($fecha);
        $diferenciaEnSegundos = $segundosHoy - $segundosFecha;
        return $diferenciaEnSegundos / self::DIA_EN_SEGUNDOS;
    }
    static function diasAAniosMesesYDias(int $dias): string
    {
        $resultado = "";
        // Años
        $anios = floor($dias / 365);
        if ($anios > 0) {
            $resultado .= "$anios año(s) ";
        }
        $dias = $dias % 365;
        // Meses
        $meses = floor($dias / 30);
        if ($meses > 0) {
            $resultado .= "$meses meses ";
        }
        $dias = $dias % 30;

        if ($dias > 0) {
            $resultado .= "$dias días";
        }
        return $resultado;
    }
}
