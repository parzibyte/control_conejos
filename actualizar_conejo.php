<?php

use Parzibyte\Conejos;

include_once "vendor/autoload.php";
$id = $_POST["id"];
$descripcion = $_POST["descripcion"];
$genero = $_POST["genero"];
$fechaNacimiento = $_POST["fecha_nacimiento"];
$ok = Conejos::actualizarConejo($id, $descripcion, $genero, $fechaNacimiento);
if (!$ok) {
    echo "Error registrando";
} else {
    header("Location: conejos.php");
}
