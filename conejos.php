<?php


include_once "encabezado.php";

use Parzibyte\Conejos;
use Parzibyte\Fechas;

$conejos = Conejos::obtener();
?>
<div class="row">
    <div class="col">
        <a class="btn btn-success mb-2" href="formulario_registrar_conejo.php">Nuevo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Fecha de nacimiento</th>
                    <th>Edad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conejos as $conejo) { ?>
                    <tr>
                        <td> <?php echo $conejo->id ?> </td>
                        <td> <?php echo $conejo->descripcion ?> </td>
                        <td> <?php echo $conejo->genero ?> </td>
                        <td> <?php echo $conejo->fecha_nacimiento ?> </td>
                        <td> <?php echo Fechas::diasAAniosMesesYDias(Fechas::diasTranscurridosHastaHoy($conejo->fecha_nacimiento)) ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "pie.php" ?>