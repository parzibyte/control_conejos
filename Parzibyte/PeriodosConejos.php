<?php

namespace Parzibyte;

class PeriodosConejos
{
    const DIAS_INICIO_REPRODUCCION_HEMBRA = 135; // 4 meses y medio
    const DIAS_INICIO_REPRODUCCION_MACHO = 150; // 5 meses
    const DIAS_SACRIFICAR = 75;
    const GENERO_HEMBRA = "H";
    const GENERO_MACHO = "M";
    static function obtenerInformacion($idConejo, $fechaNacimiento, $genero): array
    {
        $informacion = [];
        $diasEdad = Fechas::diasTranscurridosHastaHoy($fechaNacimiento);
        $estaEnGestacion = CubricionConejos::informacionGestacion($idConejo) !== false;
        if (self::puedeReproducirse($diasEdad, $genero) && !$estaEnGestacion) {
            $informacion[] = "Listo para reproducirse";
        }
        if (self::deberiaSacrificarse($diasEdad) && !$estaEnGestacion) {
            $informacion[] = "Listo para sacrificio";
        }
        if ($estaEnGestacion) {
            $informacionGestacion = CubricionConejos::informacionGestacion($idConejo);
            $informacion[] = ("En gestación (" . Fechas::diasTranscurridosHastaHoy($informacionGestacion->fecha_inicio) . " días)");
            $informacion = array_merge($informacion, self::informacionGestacion($idConejo));
        }
        return $informacion;
    }

    static function informacionGestacion($idConejo)
    {
        $informacion = [];
        $informacionGestacion = CubricionConejos::informacionGestacion($idConejo);
        if (!$informacionGestacion) {
            return $informacion;
        }
        $diasGestacion = Fechas::diasTranscurridosHastaHoy($informacionGestacion->fecha_inicio);
        if ($diasGestacion >= 14 && $diasGestacion <= 16) {
            $informacion[] = "Realizar palpación";
        } else if ($diasGestacion >= 25 && $diasGestacion <= 27) {
            $informacion[] = "Poner nido para parto";
        } else if ($diasGestacion >= 30 && $diasGestacion < 35) {
            $informacion[] = "Parto";
        } else if ($diasGestacion >= 35) {
            $informacion[] = "Destetar";
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
