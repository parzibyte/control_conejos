<?php

namespace Parzibyte;

class PeriodosConejos
{
    const DIAS_INICIO_REPRODUCCION_HEMBRA = 135; // 4 meses y medio
    const DIAS_INICIO_REPRODUCCION_MACHO = 150; // 5 meses
    const DIAS_SACRIFICAR = 75;
    const GENERO_HEMBRA = "H";
    const GENERO_MACHO = "M";
    static function obtenerInformacion($fechaNacimiento, $genero): array
    {
        $informacion = [];
        $diasEdad = Fechas::diasTranscurridosHastaHoy($fechaNacimiento);
        if (self::puedeReproducirse($diasEdad, $genero)) {
            $informacion[] = "Listo para reproducirse";
        }
        if (self::deberiaSacrificarse($diasEdad)) {
            $informacion[] = "Listo para sacrificio";
        }
        return $informacion;
    }

    static function puedeReproducirse($diasEdad, $genero)
    {
        if ($genero == self::GENERO_HEMBRA) {
            return $diasEdad >= self::DIAS_INICIO_REPRODUCCION_HEMBRA;
        } else {
            return $diasEdad >= self::DIAS_INICIO_REPRODUCCION_MACHO;
        }
    }
    static function deberiaSacrificarse($diasEdad)
    {
        return $diasEdad >= self::DIAS_SACRIFICAR;
    }
}
