<?php

use Parzibyte\CubricionConejos;

include_once "vendor/autoload.php";
$fecha = $_POST["fecha_inicio"];
$idConejo = $_POST["id_conejo"];
$ok = CubricionConejos::iniciarCubricion($idConejo, $fecha);
if (!$ok) {
    echo "Error registrando";
} else {
    header("Location: cubricion.php?id=" . $idConejo);
}
