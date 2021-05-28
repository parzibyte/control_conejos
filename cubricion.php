<?php
if (!isset($_GET["id"])) {
    exit("No hay id");
}

use Parzibyte\Conejos;
use Parzibyte\CubricionConejos;
use Parzibyte\Fechas;
use Parzibyte\PeriodosConejos;

include_once "encabezado.php";
$coneja = Conejos::uno($_GET["id"]);
?>
<div class="row">
    <div class="col-12">
        <h2>Cubrición</h2>
    </div>
    <div class="col-lg-3">
        <a class="btn btn-warning mb-2" href="conejos.php">Volver</a>
        <div class="alert alert-success">
            <strong><?php echo $coneja->descripcion ?></strong>
            <br>
            <strong>Edad:</strong> <?php echo Fechas::diasAAniosMesesYDias(Fechas::diasTranscurridosHastaHoy($coneja->fecha_nacimiento)) ?>
        </div>
    </div>
    <?php
    $informacion = CubricionConejos::informacionGestacion($coneja->id);
    if (!$informacion) { ?>
        <div class="col-lg-3">
            <h3>Marcar cubrición</h3>
            <form action="iniciar_cubricion.php" method="post">
                <input type="hidden" value="<?php echo $coneja->id ?>" name="id_conejo">
                <label for="fecha_inicio" class="form-label">Fecha</label>
                <input required class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo date("Y-m-d") ?>">
                <button class="btn btn-primary mt-2">Iniciar</button>
            </form>
        </div>
    <?php } else { ?>
        <div class="col-lg-3">
            En gestación desde <?php echo $informacion->fecha_inicio ?> (<?php echo Fechas::diasTranscurridosHastaHoy($informacion->fecha_inicio) ?> días)
            <?php $informacionGestacion = PeriodosConejos::informacionGestacion($coneja->id); ?>
            <br>
            <strong>Información: </strong>
            <ul class="list-group list-group-flush">
                <?php foreach ($informacionGestacion as $punto) { ?>
                    <li class="list-group-item"><?php echo $punto ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-3">
            <h3>Fin de gestación</h3>
            <form action="detener_gestacion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $informacion->id ?>">
                <input type="hidden" name="id_conejo" value="<?php echo $coneja->id ?>">
                <label for="fecha" class="form-label">Fecha</label>
                <input required class="form-control" type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d") ?>">
                <label for="exitosa">¿Fue exitosa?</label>
                <select class="form-select" name="exitosa" id="exitosa" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <button class="btn btn-primary mt-2">Marcar fin</button>
            </form>
        </div>
    <?php } ?>
</div>
<?php include_once "pie.php" ?>