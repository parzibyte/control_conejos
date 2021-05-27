<?php

use Parzibyte\CubricionConejos;

include_once "vendor/autoload.php";
$id = $_POST["id"];
$idConejo = $_POST["id_conejo"];
$fecha = $_POST["fecha"];
$exitosa = $_POST["exitosa"] === "1";
$ok = CubricionConejos::marcarFinGestacion($id, $fecha, $exitosa);
if (!$ok) {
    echo "Error guardando";
} else {
    header("Location: cubricion.php?id=" . $idConejo);
}
