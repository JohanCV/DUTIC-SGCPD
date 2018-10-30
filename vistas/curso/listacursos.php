<h3>CURSOS DE CAPACITACION</h3>
   
<!--agregar cursos-->
<?php if (isset($_SESSION['identity'])):?>
    <div class="agregar">
        <a href="" >
        <i class="fas fa-plus-circle fa-2x"></i>
        </a>
    </div>

<?php endif;?>

<?php if (!isset($_SESSION['identity'])):?>
    <?php require_once 'controladores/CursoController.php';
        //se duplica la pagination x hacer doble instancia
        $course = new CursoController();
        $CURSO =$course->listacursos();
    ?>
<!--cursos disponibles -->
    <?php while ($curso = $CURSO->fetch_object()): ?>
        <div id="central">
            <div class="curso">
                <img src="<?=base_url?>assets/img/moodle.png" alt="moodle">
                <h2><?= $curso->nombre; ?></h2>
                <p>Hora: <?= $curso->horainicio; ?></p>
                <p>Hora: <?= $curso->horafinal; ?></p>
                <p>Dia: <?= $curso->fecha; ?> </p>
                <p>Profesor: <?= $curso->idprofesor; ?></p>
                <a href="" class="btn btn-dark">Inicie Sesion</a>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <?php while ($curso = $CURSO->fetch_object()): ?>
        <div id="central">
            <div class="curso">
                <img src="<?=base_url?>assets/img/moodle.png" alt="moodle">
                <h2><?= $curso->nombre; ?></h2>
                <p>Hora: <?= $curso->horainicio; ?></p>
                <p>Hora: <?= $curso->horafinal; ?></p>
                <p>Dia: <?= $curso->fecha; ?> </p>
                <p>Profesor: <?= $curso->idprofesor; ?></p>
                <a href="<?=base_url?>cursocontroller/editar&id=<?= $docente->idusu ?>"
                >
                    <i class="fas fa-edit"></i></a>
                <a href="<?=base_url?>cursocontroller/eliminar&id=<?= $docente->idusu ?>"
                >
                    <i class="far fa-trash-alt"></i></a>

                <a href="" class="btn btn-dark">Ver</a>
            </div>
        </div>

    <?php endwhile; ?>

<?php endif;?>
