<?php


include_once "encabezado.php";

use Parzibyte\Conejos;
use Parzibyte\Fechas;
use Parzibyte\PeriodosConejos;

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
                    <th>Edad</th>
                    <th>Información</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conejos as $conejo) { ?>
                    <tr>
                        <td> <?php echo $conejo->id ?> </td>
                        <td> <?php echo $conejo->descripcion ?> </td>
                        <td> <?php echo $conejo->genero ?> </td>
                        <td> <?php echo Fechas::diasAAniosMesesYDias(Fechas::diasTranscurridosHastaHoy($conejo->fecha_nacimiento)) ?> </td>
                        <td>
                            <ul class="list-group list-group-flush">
                                <?php
                                $informacion = PeriodosConejos::obtenerInformacion($conejo->id, $conejo->fecha_nacimiento, $conejo->genero);
                                foreach ($informacion as $punto) { ?>
                                    <li class="list-group-item"><?php echo $punto ?></li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <?php if (PeriodosConejos::puedeReproducirse(Fechas::diasTranscurridosHastaHoy($conejo->fecha_nacimiento), $conejo->genero)) { ?>
                                <a href="cubricion.php?id=<?php echo $conejo->id ?>" class="btn btn-success">Cubrición</a>
                            <?php } ?>
                            <a href="#" class="btn btn-warning">Editar</a>
                            <a href="eliminar_conejo.php?id=<?php echo $conejo->id ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "pie.php" ?>