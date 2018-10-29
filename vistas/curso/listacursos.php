<h3>CURSOS</h3>
   
<!--agregar cursos-->
<div class="agregar">
    <a href="" > 
    <i class="fas fa-plus-circle fa-2x"></i>
    </a> 
</div>


<!--cursos disponibles -->
<?php while ($curso = $CURSO->fetch_object()): ?>
    <div id="central">
        <div class="curso">
            <img src="<?=base_url?>assets/img/moodle.png" alt="moodle">
            <h2><?= $curso->nombre; ?></h2>
            <p>Hora: <?= $curso->hora; ?></p>
            <p>Dia: <?= $curso->dia; ?> </p>
            <p>Profesor: <?= $curso->profesor; ?></p>
            <a href="" class="btn btn-dark">Ver</a>
        </div>
    </div>

<?php endwhile; ?>