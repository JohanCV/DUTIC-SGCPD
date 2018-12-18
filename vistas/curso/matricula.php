<h3>MATRICULA </h3>

<?php //require_once 'vistas/layout/buscar.php'?>
<form action="<?=base_url?>cursocontroller/savematricula" method="post">
  <?php if(isset($_SESSION['buscarusercourse']) && $_SESSION['buscarusercourse'] == 'encontrado'):?>

    <input class="form-control mr-sm-2" name="estado"
           value="si">
    <label for=""></label>
    <?php //$iddocente = $_GET['idoc']?>
    <input class="form-control mr-sm-2" name="usuario"
           placeholder="">
    <label for=""></label>
    <?php $cursoutil = Utils::showCurso();?>
    <div class="form-label-group">
        <select class="form-control" name="curso" id="" >
            <?php while ($c = $cursoutil->fetch_object() ):?>
                <option value="<?=$c->idcurso?>">
                    <?=$c->nombre?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="inputCP"></label>
    </div>


    <?php $cursoprueb = Utils::showCursoPrueba();?>
    <div class="form-label-group">
        <select class="form-control" name="cursoprueba" id="" >
            <?php while ($cp = $cursoprueb->fetch_object() ): var_dump($cp);?>
                <option value="<?=$cp->idcursoprueba ?>"
                  <?= isset($trycourse) && is_object($trycourse) && $cp->idcursoprueba == $trycourse->idcursoprueba ? 'selected' : ''; ?>>
                    <?=$cp->nombrecp?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="inputCP"></label>
    </div>

    <button class="btn btn-lg btn-warning"
            data-toggle="modal"
            data-target="#exampleModal"
            type="submit">Matricular</button>
  <?php endif;?>
</form>
