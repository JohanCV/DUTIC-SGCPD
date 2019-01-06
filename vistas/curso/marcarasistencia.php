<h3>CONTROL DE ASISTENCIA</h3>

<?php //require_once 'vistas/layout/buscar.php'?>

<form action="<?=base_url?>cursocontroller/saveasistencia" method="post">
  <?php if(isset($_SESSION['buscarusercourse']) && $_SESSION['buscarusercourse'] == 'encontrado'):?>
    <br>
    <label for="">Asistencia si o no:</label>
    <input class="form-control mr-sm-2" name="estado" placeholder="Ingrese la asistencia"
           required value="no">
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
    <button class="btn btn-lg btn-warning"
            data-toggle="modal"
            data-target="#exampleModal"
            type="submit">Asistio</button>
  <?php endif;?>
</form>
