<?php
if (!isset($_GET["id"])) {
    exit("No hay id");
}

use Parzibyte\Conejos;
use Parzibyte\PeriodosConejos;

include_once "encabezado.php";
$conejo = Conejos::uno($_GET["id"]);
?>
<div class="row">
    <div class="col-lg-3">
        <h2>Editar conejo</h2>
        <form action="actualizar_conejo.php" method="post">
            <input type="hidden" name="id" value="<?php echo $conejo->id ?>">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea required placeholder="Nombre, corral, etcétera" name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"><?php echo $conejo->descripcion ?></textarea>
            <label for="genero" class="form-label">Género</label>
            <select required name="genero" id="genero" class="form-select">
                <option <?php if ($conejo->genero === PeriodosConejos::GENERO_MACHO) {
                            echo "selected";
                        } ?> value="M">Macho</option>
                <option <?php if ($conejo->genero === PeriodosConejos::GENERO_HEMBRA) {
                            echo "selected";
                        } ?> value="H">Hembra</option>
            </select>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input value="<?php echo $conejo->fecha_nacimiento ?>" required class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento">
            <button class="btn btn-primary mt-2">Guardar</button>
            <a href="conejos.php" class="btn btn-warning mt-2">Volver</a>
        </form>
    </div>
</div>
<?php include_once "pie.php" ?>