<h3>ASISTENCIA</h3>

<?php require_once 'vistas/layout/buscar.php'?>
<a href="<?=base_url?>cursocontroller/asistentes&id=<?=$_GET['idasis']?>"
   class="btn btn-xs btn-secondary">
    <i class="fas fa-chevron-circle-left fa-1x"></i></a>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">Fecha</th>
        <th scope="col">Curso</th>
        <th scope="col">Docente</th>
        <th scope="col">Asistencia</th>
        <th scope="col">Nota</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php while ($asis = $cursoasistencia->fetch_object() ): ?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td><?= $asis->fecha ?></td>
                <td><?= $asis->nombre ?></td>
                <td><?= $asis->Docente ?></td>
                <td><?= $asis->estado ?></td>
                <td><?= $asis->nota?></td>
            </tr>
            <?php $contador++; ?>
        <?php endwhile; ?>

    </tbody>
</table>
