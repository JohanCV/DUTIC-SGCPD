<h3>CONTROL DE ASISTENCIA</h3>

<?php //require_once 'vistas/layout/buscar.php'?>

<form action="<?=base_url?>cursocontroller/saveasistencia&idcurso=<?=$_GET['idcurso']?>" method="post">
    <br>
    <label for="">Asistencia si o no:</label>

    <select class="form-control" name="estado" id="" >
        <option value="no">No</option>
        <option value="si">Si</option>
    </select>
    <br>
    <label for="">Nota</label>
    <input class="form-control mr-sm-2" name="nota" placeholder="Ingrese la nota"
           required value="0">
    <label for=""></label>
    <br>

    <label for="">Fecha:</label>
    <?php $date = Utils::showFecha();?>
    <div class="form-label-group">
        <select class="form-control" name="fecha" id="" >
            <?php while ($fecha = $date->fetch_object() ):?>
                <option value="<?=$fecha->idfecha?>">
                    <?=$fecha->fecha?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <label for=""></label>
    <br>

    <label for="">Usuario:</label>
    <?php $uc = Utils::showUser($_GET['idusu']);?>
    <div class="form-label-group">
      <select class="form-control" name="user" id="" >
        <?php while ($usercur = $uc->fetch_object() ):?>
          <option value="<?=$usercur->iduc?>">
              <?=$usercur->docente?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <br>
    <button class="btn btn-lg btn-success"
            data-toggle="modal"
            data-target="#exampleModal"
            type="submit">Asistio</button>

</form>
