<?php include_once "encabezado.php" ?>
<div class="row">
    <div class="col-lg-3">
        <h2>Nuevo conejo</h2>
        <form action="guardar_conejo.php" method="post">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea required placeholder="Nombre, corral, etcétera" name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
            <label for="genero" class="form-label">Género</label>
            <select required name="genero" id="genero" class="form-select">
                <option value="M">Macho</option>
                <option value="H">Hembra</option>
            </select>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input required class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento">
            <button class="btn btn-primary mt-2">Guardar</button>
        </form>
    </div>
</div>
<?php include_once "pie.php" ?>