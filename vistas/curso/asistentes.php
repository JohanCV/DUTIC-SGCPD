<h3>MATRICULADOS</h3>

<?php require_once 'vistas/layout/buscar.php'?>
<a href="<?=base_url?>cursocontroller/asistencia&idasis=<?=$_GET['id']?>"
   class="btn btn-xs btn-warning">
    <i class="fas fa-user-edit"></i> Asistentes</a>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">NOMBRES</th>
        <th scope="col">CURSO</th>
        <th scope="col">CURSO PRUEBA</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCION</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php while ($cursomatriculados = $cursomatri->fetch_object() ):?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td><?= $cursomatriculados->idusu; ?></td>
                <td><?= $cursomatriculados->idcurso; ?></td>
                <td><?= $cursomatriculados->idcursoprueba; ?></td>
                <td><?= $cursomatriculados->estadoasistencia; ?></td>
                <td>
                    <a href="<?=base_url?>cursocontroller/marcarasistencia&idusu=<?= $cursomatriculados->iduc ?>"
                       class="btn btn-xs btn-danger">
                        <i class="fas fa-user-times"></i> Asistencia</a>
                </td>
            </tr>
            <?php $contador++; ?>
        <?php endwhile; ?>

    </tbody>
</table>
