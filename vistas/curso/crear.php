<?php if (isset($edit) && isset($edicion) && is_object($edicion)):?>
  <h3>Edicion del Curso de Capacitacion <?= $edicion->nombre ?></h3>
  <?php $url_action = base_url."cursocontroller/save&id=".$edicion->idcurso; ?>
<?php else : ?>
  <h3>Creacion de Cursos de Capacitacion</h3>
  <?php $url_action = base_url."cursocontroller/save"; ?>
<?php endif;?>


<?php ?>
<?php ?>
<form action="<?=$url_action ?>" method="POST" >

    <div class="form-label-group">
        <label for="inputNombre"></label>
        <input type="texto" name="nombre" id="inputNombre"
               class="form-control" placeholder="Ingrese el Nombre Completo del Curso"
               required="" autofocus=""
               value="<?= isset($edicion) && is_object($edicion)?$edicion->nombre : ''; ?>">
        <label for="inputNombre"></label>
    </div>

    <div class="form-label-group">
        <input type="texto" name="nombrecorto" id="nombreCorto"
               class="form-control" placeholder="Ingrese el Nombre Corto del Curso" required="" autofocus=""
               value="<?= isset($edicion) && is_object($edicion)?$edicion->nombrecorto : ''; ?>">
        <label for="nombreCorto"></label>
    </div>

    <div class="form-label-group">
        <input type="text" name="horainicio" id="horaInicio"
               class="form-control" placeholder="Ingrese la hora de inicio del curso" required="" autofocus=""
               value="<?= isset($edicion) && is_object($edicion)?$edicion->horainicio : ''; ?>">
        <label for="horaInicio"></label>
    </div>

    <div class="form-label-group">
        <input type="text" name="horafin" id="horaFin"
               class="form-control" placeholder="Ingrese la hora de fin del curso" required=""
               value="<?= isset($edicion) && is_object($edicion)?$edicion->horafinal : ''; ?>">
        <label for="horaFin"></label>
    </div>

    <div class="form-label-group">
        <textarea type="text" name="contenido" id="contenidoCurso"
               class="form-control" placeholder="Ingrese el Contenido del Curso"
               value="<?= isset($edicion) && is_object($edicion) ? $edicion->contenido : $edicion->contenido; ?>">
        </textarea>
        <label for="contenidoCurso"></label>
    </div>

    <?php $profesor = Utils::showProfesor();?>
    <div class="form-label-group">
        <select class="form-control" name="profesor" id="" >
            <?php while ($prof = $profesor->fetch_object() ): ?>
                <option value="<?=$prof->idprofesor?>"
                  <?= isset($edicion) && is_object($edicion) && $prof->idprofesor == $edicion->idprofesor ? 'selected' : ''; ?>>
                    <?=$prof->nombre?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="profesor"></label>
    </div>

    <?php if (isset($edit) && $edit == true): ?>
        <button class="btn btn-lg btn-warning"
                data-toggle="modal"
                data-target="#exampleModal"
                type="submit">Editar Curso</button>
        <a href="<?php base_url?>listacursos"
           class="btn btn-lg btn-danger">Cancelar</a>

    <?php else: ?>
        <button class="btn btn-lg btn-primary"
                data-toggle="modal"
                data-target="#exampleModal"
                type="submit">Registrar Curso</button>
        <a href="<?php base_url?>listacursos"
           class="btn btn-lg btn-danger">Cancelar</a>
    <?php endif; ?>
</form>
