<?php

use Parzibyte\Conejos;

include_once "vendor/autoload.php";
$id = $_GET["id"];
$ok = Conejos::eliminar($id);
if (!$ok) {
    echo "Error eliminando";
} else {
    header("Location: conejos.php");
}

