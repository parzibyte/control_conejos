<?php

use Parzibyte\Conejos;

include_once "vendor/autoload.php";
$descripcion = $_POST["descripcion"];
$genero = $_POST["genero"];
$fechaNacimiento = $_POST["fecha_nacimiento"];
$ok = Conejos::registrarConejo($descripcion, $genero, $fechaNacimiento);
if (!$ok) {
    echo "Error registrando";
} else {
    header("Location: conejos.php");
}
