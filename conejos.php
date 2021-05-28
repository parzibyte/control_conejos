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
                        <td>
                            <?php if ($conejo->genero === PeriodosConejos::GENERO_HEMBRA) { ?>
                                <i class="bi-gender-female" style="font-size: 2rem; color:pink;"></i>
                            <?php } else { ?>
                                <i class="bi-gender-male" style="font-size: 2rem; color:blue;"></i>
                            <?php } ?>
                        </td>
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
                            <?php if ($conejo->genero === PeriodosConejos::GENERO_HEMBRA && PeriodosConejos::puedeReproducirse(Fechas::diasTranscurridosHastaHoy($conejo->fecha_nacimiento), $conejo->genero)) { ?>
                                <a title="Cubrición y gestación" href="cubricion.php?id=<?php echo $conejo->id ?>" class="btn btn-success mb-1">
                                    <i class="bi-heart"></i>
                                </a>
                            <?php } ?>
                            <a href="formulario_editar_conejo.php?id=<?php echo $conejo->id ?>" class="btn btn-warning mb-1">
                                <i class="bi-pencil"></i>
                            </a>
                            <a href="eliminar_conejo.php?id=<?php echo $conejo->id ?>" class="btn btn-danger mb-1">
                                <i class="bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "pie.php" ?>